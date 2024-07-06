<?php
  include_once("../php/crud_db.php");

  $database = new crud_db();

  session_start();

  $_SESSION["id"] = -1;
  $_SESSION["action"] = "insert";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="..\..\style.css">
    <script type="text/javascript" src="..\..\js\hidenav.js"></script>
</head>
<body>
    <div class="header" id="header">
      <section id="navigation">
          <ul class="nav">
            <li class="nav"><a class="nav" href="..\..\index.html">Home</a></li>
            <li class="nav"><a class="nav" href="..\visitor\index.php">Book a Visit</a></li>
            <li class="nav"><a class="nav" href="..\visitor\bookings.php">View Bookings</a></li>
            <li class="nav" style="float:right"><a class="navActive" href="manage.php">Admin</a></li>
          </ul>
          <div align="center" class="navborder"></div>
      </section>
    </div>

    <div class="messege">
      <?php print("Welcome Admin"); ?>
      <a href="..\visitor\logout.php">
        <button type="button" class="button">Log Out</button>
      </a>
    </div>
    <div class="messege text">
      Below you can create a new site.
    </div>

    <div class="parent">
    <div class="form">
        <h1>Create New Site</h1>

        <!-- uses html validation attributes on form elements for input validation -->
        <form id="update" action="../php/save.php" method="post">
          <div class="form_input">
          <input type="text" id="siteName" name="siteName" placeholder="" value="" required>
          <label for="siteName"> Site Name: </label>
          </div>

          <div class="form_input">
          <input type="text" id="location" name="location" placeholder="" value="" required>
          <label for="location"> Location: </label>
          </div>

          <div class="form_input">
          <input type="text" id="feature" name="feature" placeholder="" value="">
          <label for="feature"> Feature: </label>
          </div>

          <div class="form_input">
          <input type="text" id="contact" name="contact" placeholder="" value="">
          <label for="contact"> Contact: </label>
          </div>

          <div class="form_input">
          <input type="text" id="priceFrom" name="priceFrom" pattern="^\d+(\.\d{2})?$"
           placeholder="" title="Price with cents or without" value="">
          <label for="priceFrom"> Price from: </label>
          </div>

          <input type="submit"></input>
          <input type="reset" onclick=document.getElementById("update").reset();></input>
          <a href="get_sites.php">
            <input type="button" value="Go Back" />
          </a>
        </form>
    </body>
  </div>
</html>
