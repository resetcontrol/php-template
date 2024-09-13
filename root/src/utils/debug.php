<?php
function dump($message) {
  echo "<pre>" . htmlentities(utf8_encode(print_r($message, true))) . "</pre>";
}

function traceEntryHasFileInfo($entry) {
  return isset($entry["file"]) && isset($entry["line"]);
}

function traceEntryFormat($entry) {
  return $entry["file"] . "(" . $entry["line"] . ")";
}

function getTraceFormatted($exception) {
  return array_map(
    "traceEntryFormat",
    array_filter($exception->getTrace(), "traceEntryHasFileInfo")
  );
}

function showDebugInfo() {
  return @value($_GET["debug"], "false") == "true";
}
?>
