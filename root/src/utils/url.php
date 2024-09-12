<?php
function urlQueryParams($params, $options = null) {
  $defaultOptions = array("preserveParams" => false);

  $config = array(
    "preserveParams" => @value(
      $options["preserveParams"],
      $defaultOptions["preserveParams"]
    )
  );

  $baseParams = $config["preserveParams"] ? $_GET : array();
  return array_merge($baseParams, $params);
}
?>
