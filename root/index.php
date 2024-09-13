<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="src/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/svg+xml" href="public/php-logo.png" />
    <title>PHP Template</title>
  </head>
  <body>
    <?php
    require "polyfills/polyfills.php";
    require "lib/lib.php";

    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();

    require "src/app.php";
    ?>
  </body>
</html>
