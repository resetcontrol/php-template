<?php
function isTruthy($value) {
  return !!$value;
}

function value($expr, $default = null) {
  return isset($expr) ? $expr : $default;
}
?>
