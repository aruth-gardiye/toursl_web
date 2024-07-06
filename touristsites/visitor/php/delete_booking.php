<?php
  include_once("../../php/crud_db.php");

  $database = new crud_db();

  $database -> delete_data("Booking", $_GET["ticketID"]);

  $return = $_SERVER['HTTP_REFERER'];

  header('Location: ' . $_SERVER['HTTP_REFERER']);
  exit();
 ?>
