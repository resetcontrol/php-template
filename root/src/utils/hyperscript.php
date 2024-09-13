<?php
function classNames($classNames) {
  if (gettype($classNames) == "string") {
    return $classNames;
  }

  return implode(" ", array_keys(array_filter($classNames, "isTruthy")));
}

function style($styles) {
  $rules = array();

  foreach ($styles as $key => $value) {
    if (!strlen($value)) {
      continue;
    }

    array_push($rules, "${key}: ${value};");
  }

  return implode(" ", $rules);
}

function attributePair($key, $value) {
  $valueStr = gettype($value) == "boolean" ? "" : "$value";
  return "$key" . (strlen($valueStr) ? "=\"$valueStr\"" : "");
}

function attrs($attributes) {
  if (!isset($attributes) || gettype($attributes) != "array") {
    return "";
  }

  $acc = array();

  foreach (array_filter($attributes, "isTruthy") as $key => $value) {
    if ($key == "class") {
      $classNames = classNames($value);

      if (strlen($classNames)) {
        array_push($acc, "class=\"${classNames}\"");
      }

      continue;
    }

    if ($key == "style") {
      $style = style($value);

      if (strlen($style)) {
        array_push($acc, "style=\"${style}\"");
      }

      continue;
    }

    array_push($acc, attributePair($key, $value));
  }

  return implode(" ", $acc);
}

function children($children) {
  if (gettype($children) == "array") {
    return implode("", $children);
  }

  return $children;
}

function htmlElement($tagName, $attributes, $children) {
  $attrs = attrs($attributes);
  $tag = $tagName . (empty($attrs) ? "" : " ") . $attrs;
  return "<$tag>" . children($children) . "</$tagName>";
}
?>
