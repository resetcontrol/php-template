<?php
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
  if (error_reporting() == 0) {
    return;
  }

  throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});

$db = null;

try {
  $db = odbc_connect(getenv("ODBC_NAME"), "", "");
} catch (Exception $exception) {
  echo iconv('ISO-8859-1', 'UTF-8', $exception->getMessage());
}

function db() {
  global $db;
  return $db;
}

function init() {
  return isTruthy(db());
}
?>
