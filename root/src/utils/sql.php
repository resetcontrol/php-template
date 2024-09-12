<?php
function escapeSingleQuote($str) {
  return str_replace("'", "''", $str);
}

function interpolate($str, $params) {
  $acc = $str;

  foreach ($params as $key => $value) {
    $acc = str_replace(":${key}", "'" . escapeSingleQuote($value) . "'", $acc);
  }

  return $acc;
}

function executeQuery($query, $params = null) {
  $statement = isset($params) ? interpolate($query, $params) : $query;
  $resource = null;

  if (showDebugInfo()) {
    dump($statement);
  }

  try {
    $resource = odbc_exec(db(), $statement);
  } catch (Exception $exception) {
    dump(array(
      "trace" => getTraceFormatted($exception),
      "error code" => odbc_error(),
      "error message" => odbc_errormsg(),
      "query" => $statement
    ));

    return null;
  }

  return $resource;
}

function fetchRow($resource) {
  if (!odbc_fetch_row($resource)) {
    return null;
  }

  $row = array();

  for (
    $fieldIndex = 1;
    $fieldIndex <= odbc_num_fields($resource);
    $fieldIndex++
  ) {
    $fieldName = odbc_field_name($resource, $fieldIndex);

    $row[$fieldName] = iconv(
      "CP850",
      "UTF-8",
      trim(odbc_result($resource, $fieldName))
    );
  }

  return $row;
}

function fetchFirstRow($query, $params = null) {
  $resource = executeQuery($query, $params);

  if (!$resource) {
    return null;
  }

  return fetchRow($resource);
}

function fetchAll($query, $params = null) {
  $resource = executeQuery($query, $params);

  if (!$resource) {
    return array();
  }

  $rows = array();

  while ($row = fetchRow($resource)) {
    array_push($rows, $row);
  }

  return $rows;
}

function queryBuilder($clauses) {
  $select = "";

  if (isset($clauses["select"])) {
    $select = is_array($clauses["select"])
      ? "SELECT\n  " . implode(",\n  ", $clauses["select"])
      : "SELECT " . $clauses["select"];
  }

  if (isset($clauses["select distinct"])) {
    $select = is_array($clauses["select distinct"])
      ? "SELECT DISTINCT\n  " . implode(",\n  ", $clauses["select distinct"])
      : "SELECT DISTINCT " . $clauses["select distinct"];
  }

  $from = is_array($clauses["from"])
    ? "FROM\n  " . implode(",\n  ", $clauses["from"])
    : "FROM " . $clauses["from"];

  $where = "";

  if (isset($clauses["where"])) {
    $where = is_array($clauses["where"])
      ? "WHERE\n  " . implode(" AND\n  ", $clauses["where"])
      : "WHERE " . $clauses["where"];
  }

  $groupBy = "";

  if (isset($clauses["group by"])) {
    $groupBy = is_array($clauses["group by"])
      ? "GROUP BY\n  " . implode(",\n  ", $clauses["group by"])
      : "GROUP BY " . $clauses["group by"];
  }

  $having = "";

  if (isset($clauses["having"])) {
    $having = is_array($clauses["having"])
      ? "HAVING\n  " . implode(" AND\n  ", $clauses["having"])
      : "HAVING " . $clauses["having"];
  }

  $orderBy = "";

  if (isset($clauses["order by"])) {
    $orderBy = is_array($clauses["order by"])
      ? "ORDER BY\n  " . implode(",\n  ", $clauses["order by"])
      : "ORDER BY " . $clauses["order by"];
  }

  $queryArray = array($select, $from, $where, $groupBy, $having, $orderBy);
  return "\n" . implode("\n", array_filter($queryArray, "isTruthy")) . "\n";
}
?>
