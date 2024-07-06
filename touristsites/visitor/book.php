<?php

  session_start();
  $_SESSION["Booking_action"] = "insert";

  #if accessing booking directly without session visitor id, redirect to login
  if (empty($_SESSION["visitorID"]) && empty($_POST['visitor_phn'])) {
    header("Location: index.php");
    die();

  #if session visitor id is set, okay
  } elseif (!empty($_SESSION["visitorID"])) {

    include_once("../php/crud_db.php");
    $database = new crud_db();

    #get site data
    $sites = $database -> select_data("Site", -1);

  #if session visitor id is empty and post array is not empty
  } elseif (empty($_SESSION["visitorID"]) && !empty($_POST['visitor_phn'])) {

    $visitor_name = trim(htmlspecialchars($_POST['visitor_name']));
    $visitor_phn = trim(htmlspecialchars($_POST['visitor_phn']));
    $visitor_id = "";

    include_once("../php/crud_db.php");
    $database = new crud_db();

    $row = $database -> select_data("Visitor", $visitor_phn);

    #check if visitor exists in the db
    if (is_null($row)) {
      $inputlist = array(
        "visitorName" => $visitor_name,
        "visitorContact" => $visitor_phn
      );

      #insert new visitor to db
      $database -> insert_data("Visitor", -1, $inputlist);

      #retrieve visitor id
      $row = $database -> select_data("Visitor", $visitor_phn);
      $_SESSION["visitorName"] = $visitor_name = $row["visitorName"];
      $_SESSION["visitorID"] = $visitor_id = $row["visitorID"];

      #get site data
      $sites = $database -> select_data("Site", -1);


    #if an existing visitor
    }else {
      $_SESSION["visitorName"] = $visitor_name = $row["visitorName"];
      $_SESSION["visitorID"] = $visitor_id = $row["visitorID"];

      #get site data
      $sites = $database -> select_data("Site", -1);
    }
  }

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Book a Visit</title>
    <link rel="stylesheet" href="..\..\style.css">
    <script type="text/javascript" src="js\hidenav.js"></script>
    <script type="text/javascript" defer>
      function selectPrice(em){
        var selectedID = em.value;
        var price = document.getElementById("visitor_site_price");
        price.value = selectedID;
      }
    </script>
  </head>
  <body>
    <div class="header" id="header">
      <section id="navigation">
          <ul class="nav">
            <li class="nav"><a class="nav" href="..\..\index.html">Home</a></li>
            <li class="nav"><a class="navActive" href="index.php">Book a Visit</a></li>
            <li class="nav"><a class="nav" href="bookings.php">View Bookings</a></li>
            <li class="nav" style="float:right"><a class="nav" href="..\admin\manage.php">Admin</a></li>
          </ul>
          <div align="center" class="navborder"></div>
      </section>
    </div>

    <div class="messege">
      <?php print("Welcome " . $_SESSION["visitorName"]); ?>
      <a href="logout.php">
        <button type="button" class="button">Log Out</button>
      </a>
    </div>
    <div class="messege text">
      Please use the below form to make a new booking.
    </div>

    <div class="parent">
      <div class="form">
        <h1>Book a visit</h1>
        <form method="post" action="php\save_booking.php">
          <div class="form_input">
            <select class="" name="visitor_site" required onchange="selectPrice(this)">
              <?php
              foreach($sites as $site)
              {
                print('<option value="'.$site['siteID'].'">'.$site['siteName'].'</option>');
              }
              ?>
            </select>
            <span></span>
            <label for="visitor_site">Select a Site</label>
          </div>
          <div class="form_input">
            <select class="" id="visitor_site_price" name="visitor_site_price" disabled>
              <?php
              foreach($sites as $site)
              {
                print('<option value="'.$site['siteID'].'">'.$site['priceFrom'].'</option>');
              }
              ?>
            </select>
            <span></span>
            <label for="visitor_site">Starting Price</label>
          </div>
          <div class="form_input">
            <input type="date" name="visitor_date" required>
            <span></span>
            <label for="visitor_date">Visiting Date</label>
          </div>
          <input type="submit" name="submit" value="Book">
        </form>
      </div>
    </div>
  </body>
</html>
