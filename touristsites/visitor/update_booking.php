<?php
include_once("../php/crud_db.php");
$database = new crud_db();

// Check existence of id parameter before processing further
if(isset($_GET["ticketID"]) && !empty(trim($_GET["ticketID"]))){

  session_start();

  $_SESSION["ticketID"] = $_GET["ticketID"];
  $_SESSION["Booking_action"] = "update";

  // Get values
  $row = $database -> select_data("Booking_edit", $_SESSION["ticketID"]);

  // Get Sites
  $sites = $database -> select_data("Site", -1);

  // Retrieve individual field value
  $ticketID = $row["ticketID"];
  $siteID = $old_siteID = $_SESSION["old_booking_siteID"] = $row["siteID"];
  $siteName = $old_siteName = $_SESSION["old_booking_siteName"] = $row["siteName"];
  $entryDateTime = $old_booking_entryDateTime = $_SESSION["old_booking_entryDateTime"] = $row["entryDateTime"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Booking</title>
    <link rel="stylesheet" href="..\..\style.css">
    <script type="text/javascript" src="..\..\js\hidenav.js"></script>
</head>
<body>
  <div class="header" id="header">
    <section id="navigation">
        <ul class="nav">
          <li class="nav"><a class="nav" href="..\..\index.html">Home</a></li>
          <li class="nav"><a class="nav" href="index.php">Book a Visit</a></li>
          <li class="nav"><a class="navActive" href="bookings.php">View Bookings</a></li>
          <li class="nav" style="float:right"><a class="nav" href="..\admin\manage.php">Admin</a></li>
        </ul>
        <div align="center" class="navborder"></div>
    </section>
  </div>

<div class="messege">
  <?php print("Welcome " .$_SESSION["visitorName"]. $_SESSION["visitorID"]); ?>
  <a href="logout.php">
    <button type="button" class="button">Log Out</button>
  </a>
</div>
<div class="messege text">
  Please use the below form update your booking.
</div>

  <div class="parent">
    <div class="form">
      <h1>Edit Booking</h1>
      <!-- uses html validation attributes on form elements for input validation -->
        <form method="post" action="php\save_booking.php">
          <div class="form_input">
            <select class="" name="visitor_site" required>
              <?php
              while ($site = $sites->fetch_assoc())
              {
                printf('<option value="%s" %s>%s</option>',
                      $site['siteID'],
                      $site['siteID'] == $_SESSION["old_booking_siteID"] ? 'selected="selected"' : '',
                      $site['siteName']);
              }
              ?>
            </select>
            <span></span>
            <label for="visitor_site">Select a Site</label>
          </div>
          <div class="form_input">
            <input type="date" name="visitor_date" value="<?php print(date("Y-m-d", strtotime($entryDateTime))); ?>" required>
            <span></span>
            <label for="visitor_date">Visiting Date</label>
          </div>
          <input type="submit" name="submit" value="Update">
          <a href="bookings.php">
            <input type="button" name="return" value="Return">
        </a>
        </form>
      </div>
    </div>
  </body>
</html>
