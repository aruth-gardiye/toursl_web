<?php
  include_once("php/crud_db.php");

  $database = new crud_db();

  $database -> delete_data("Site", $_POST["siteID"]);

  header('Location: ''$_SERVER['HTTP_REFERER']');
  exit();
 ?>
