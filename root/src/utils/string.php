<?php
function zeropad($length, $value) {
  return sprintf("%0{$length}d", $value);
}
?>
