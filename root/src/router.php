<?php function router() {
  if (isset($_GET["action"])) {
    $action = $_GET["action"];

    if ($action == "example-action") {
      require "actions/example-action.php";
      return;
    }
  }

  $view = isset($_GET["view"]) ? $_GET["view"] : "";

  if ($view == "") {
    require "views/landing/landing.php";
    landing();
    return;
  }
} ?>
