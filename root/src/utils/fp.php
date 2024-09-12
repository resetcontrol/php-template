<?php
function identity($value) {
  return $value;
}

function partial(/* $func, $args... */) {
  $args = func_get_args();
  $func = array_shift($args);

  return function () use ($func, $args) {
    return call_user_func_array($func, array_merge($args, func_get_args()));
  };
}
?>
