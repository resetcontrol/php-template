<?php
require "utils/utils.php";
require "init.php";
require "router.php";

if (!init()) {
  return;
}
?>

<h1>PHP Template</h1>

<?php router(); ?>
