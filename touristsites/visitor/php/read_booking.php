<?php

include_once("../../php/crud_db.php");
$database = new crud_db();

session_start();

// Check existence of id parameter before processing further
if(isset($_GET["ticketID"]) && !empty(trim($_GET["ticketID"]))){
    // Get values
    $_ticketID = $_GET["ticketID"];
    $database = new crud_db();
    $row = $database -> select_data("Booking_view", $_ticketID);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Booking</title>
    <link rel="stylesheet" href="..\..\..\style.css">
    <script type="text/javascript" src="..\..\..\js\hidenav.js"></script>
</head>
<body>
  <div class="header">
    <div id="navigation">
      <ul class="nav">
        <li class="nav"><a class="nav" href="..\..\index.html">Home</a></li>
        <li class="nav"><a class="nav" href="book.php">Book a Visit</a></li>
        <li class="nav"><a class="navActive" href="bookings.php">View Bookings</a></li>
        <li class="nav" style="float:right"><a class="nav" href="..\..\admin\manage.php">Admin</a></li>
      </ul>
      <div align="center" class="navborder"></div>
    </div>
  </div>

  <div class="messege">
    <?php print("Welcome " . $_SESSION["visitorName"]); ?>
    <a href="logout.php">
      <button type="button" class="button">Log Out</button>
    </a>
  </div>
  <div class="messege text">
    Below you can find the record of your booking.
  </div>

    <div class="parent">
      <div class="table_style">
        <table>
          <tr>
            <th>Field Name</th>
            <th>Field Details</th>
          </tr>
          <tr>
            <th>Ticket ID</th>
            <td><?php print($row["ticketID"]) ?></td>
          </tr>
          <tr>
            <th>Visitor ID</th>
            <td><?php print($row["visitorID"]) ?></td>
          </tr>
          <tr>
            <th>Visitor Name</th>
            <td><?php print($row["visitorName"]) ?></td>
          </tr>
          <tr>
            <th>Contact</th>
            <td><?php print($row["visitorContact"]) ?></td>
          </tr>
          <tr>
            <th>Site ID</th>
            <td><?php print($row["siteID"]) ?></td>
          </tr>
          <tr>
            <th>Site Name</th>
            <td><?php print($row["siteName"]) ?></td>
          </tr>
          <tr>
            <th>Price From</th>
            <td><?php print($row["priceFrom"]) ?></td>
          </tr>
          <tr>
            <th>Entry Date</th>
            <td><?php echo date("Y-m-d", strtotime($row["entryDateTime"])) ?></td>
          </tr>
        </table>
        <span id="create"><button type="button" onclick=location.href="../bookings.php">Return to Bookings</button></span>
      </div>
    </div>
  </div>

</body>
</html>
