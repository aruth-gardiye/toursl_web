<?php
include_once("../php/crud_db.php");

session_start();
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

    // Get values
    $_id = $_GET["id"];
    $database = new crud_db();
    $row = $database -> select_data("Site", $_id);
  }
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
      Below you can find the record of the site.
    </div>

    <div class="parent">
      <div class="form">
        <h1>View Site Information</h1>
        <form method="post" action="get_sites.php">
          <div class="form_input">
            <input type="text" disabled name="siteID" required value="<?php print($row["siteID"]) ?>">
            <span></span>
            <label for="siteID">Site ID</label>
          </div>
          <div class="form_input">
            <input type="text" disabled name="siteName" required value="<?php print($row["siteName"]) ?>">
            <span></span>
            <label for="siteName">Site Name</label>
          </div>
          <div class="form_input">
            <input type="text" disabled name="location" required value="<?php print($row["location"]) ?>">
            <span></span>
            <label for="location">Location</label>
          </div>
          <div class="form_input">
            <textarea name="feature" rows="4" cols="44"><?php print($row["feature"]) ?></textarea>
            <span></span>
            <label for="feature">Feature</label>
          </div>
          <div class="form_input">
            <input type="text" disabled name="contact" required value="<?php print($row["contact"]) ?>">
            <span></span>
            <label for="contact">Contact</label>
          </div>
          <div class="form_input">
            <input type="text" disabled name="priceFrom" required value="<?php print($row["priceFrom"]) ?>">
            <span></span>
            <label for="priceFrom">Price From</label>
          </div>
          <a href="get_sites.php">
            <input type="button" name="return" value="Return">
          </a>
        </form>
      </div>
    </div>

</body>
</html>
