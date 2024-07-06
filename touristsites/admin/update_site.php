<?php
include_once("../php/crud_db.php");
$database = new crud_db();

// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

  session_start();

  $_SESSION["id"] = $_GET["id"];
  $_SESSION["action"] = "update";

  // Get values
  $row = $database -> select_data("Site", $_SESSION["id"]);

  // Retrieve individual field value
  $id = $row["siteID"];
  $siteName = $old_siteName = $_SESSION["old_siteName"] = $row["siteName"];
  $location = $old_location = $_SESSION["old_location"] = $row["location"];
  $feature = $old_feature = $_SESSION["old_feature"] = $row["feature"];
  $contact = $old_contact = $_SESSION["old_contact"] = $row["contact"];
  $priceFrom = $old_priceFrom = $_SESSION["old_priceFrom"]= $row["priceFrom"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Site</title>
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
      Below you can edit the site details.
    </div>

    <div class="parent">
    <div class="form">
        <h1>Edit Record</h1>

        <!-- uses html validation attributes on form elements for input validation -->
          <form id="update" action="../php/save.php" method="post">
            <div class="form_input">
            <input type="text" id="siteName"name="siteName" placeholder="" value="<?php echo $siteName; ?>" required>
            <label for="siteName"> Site Name: </label>
            </div>

            <div class="form_input">
            <input type="text" id="location" name="location" placeholder="" value="<?php echo $location; ?>" required>
            <label for="location"> Location: </label>
            </div>

            <div class="form_input">
            <input type="text" id="feature" name="feature" placeholder="" value="<?php echo $feature; ?>" optional>
            <label for="feature"> Feature: </label>
            </div>

            <div class="form_input">
            <input type="text" id="contact" name="contact" placeholder="" value="<?php echo $contact; ?>" optional>
            <label for="contact"> Contact: </label>
            </div>

            <div class="form_input">
            <input type="text" id="priceFrom" name="priceFrom" placeholder="" pattern="^\d+(\.\d{2})?$"
            title="Price with cents or without" value="<?php echo $priceFrom; ?>" optional>
            <label for="priceFrom"> Price from: </label>
            </div>

            <input type="submit"></button>
            <input type="reset" onclick=document.getElementById("update").reset();></button>
            <a href="get_sites.php">
              <input type="button" value="Go Back" />
            </a>
          </form>
        </div>
    </body>
  </div>
</html>
