<?php
  #Script to insert and update data into the database

  include_once("crud_db.php");
  $database = new crud_db();

  #print_r($_POST);

  session_start();

  #getting form input from _POST and putting into an array
  $inputlist = array(
    "siteName" => trim(htmlspecialchars($_POST["siteName"])),
    "location" => trim(htmlspecialchars($_POST["location"])),
    "feature" => trim(htmlspecialchars($_POST["feature"])),
    "contact" => trim(htmlspecialchars($_POST["contact"])),
    "priceFrom" => trim(htmlspecialchars($_POST["priceFrom"]))
  );

  #error handling variables
  $nameErr = false;
  $locationErr = false;
  $priceErr = false;
  $iserror = false;

  // Validate name
  if(empty($inputlist["siteName"])){
      $nameErr = true;
      $iserror = true;
  }
  // Validate location
  if(empty($inputlist["location"])){
      $locationErr = true;
      $iserror = true;
  }
  // Validate feature
  if(empty($inputlist["feature"])){
      $inputlist["feature"] = "None";
  }
  // Validate contact
  if(empty($inputlist["contact"])){
      $inputlist["contact"] = "None";
  }
  // Validate price
  if(empty($inputlist["priceFrom"])){
      $inputlist["priceFrom"] = "00.00";
  } elseif(!preg_match('/^\d+(\.\d{2})?$/', $inputlist["priceFrom"])) {
      $priceErr = true;
      $iserror = true;
  }

  #if form error
  if ($iserror){
    if ($nameErr){
      print("<p>Please enter a valid name<\p>");
    }
    if ($locationErr){
      print("<p>Please enter a valid location<\p>");
    }
    if ($priceFrom){
      print("<p>Please enter a valid price<\p>");
    }

    #end session
    session_unset();
    session_destroy();
    die();

  #update record
  }elseif( $_SESSION["action"] == "update" ){

    $database -> insert_data("site", $_SESSION["id"], $inputlist);

    print("
    <!DOCTYPE html>
    <html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
        <title>Updated Record</title>
        <link rel=\"stylesheet\" href=\"..\style.css\">
    </head>
    <body>
    <p>The following information has been updated in the database:</p>");

    if($inputlist['siteName'] != $_SESSION["old_siteName"]){
      print("<p>Name changed from: {$_SESSION["old_siteName"]} to {$inputlist['siteName']}</p>");
    }

    if($inputlist['location'] != $_SESSION["old_location"]){
      print("<p>Location changed from: {$_SESSION["old_location"]} to {$inputlist['location']}</p>");
    }

    if($inputlist['feature'] != $_SESSION["old_feature"]){
      print("<p>Feature changed from: {$_SESSION["old_feature"]} to {$inputlist['feature']}</p>");
    }

    if($inputlist['contact'] != $_SESSION["old_contact"]){
      print("<p>Contact changed from: {$_SESSION["old_contact"]} to {$inputlist['contact']}</p>");
    }

    if($inputlist['priceFrom'] != $_SESSION["old_priceFrom"]){
      print("<p>Contact changed from: {$_SESSION["old_priceFrom"]} to {$inputlist['priceFrom']}</p>");
    }

    print("<p><a href = '../get_sites.php'>Click here to view
         all tourist sites.</a></p>
    </body>
    </html>");

    #end session
    session_unset();
    session_destroy();
    die();

  #insert record
  }elseif( $_SESSION["action"] == "insert" ){

    $database -> insert_data("site", $_SESSION["id"], $inputlist);

    print("
    <!DOCTYPE html>
    <html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
        <title>Updated Record</title>
        <link rel=\"stylesheet\" href=\"..\style.css\">
    </head>
    <body>
    <p>The following information has been saved in to the database:</p>");

    print("<p>Site Name: {$inputlist['siteName']}</p>
          <p>Location: {$inputlist['location']}</p>
          <p>Feature: {$inputlist['feature']}</p>
          <p>Contact: {$inputlist['contact']}</p>
          <p>Contact: {$inputlist['priceFrom']}</p>
          <p><a href = '../get_sites.php'>Click here to view
         all tourist sites.</a></p>
    </body>
    </html>");

    #end session
    session_unset();
    session_destroy();
    die();
  }
?>
