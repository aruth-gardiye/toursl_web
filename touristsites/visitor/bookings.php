<?php
  include_once("../php/crud_db.php");
  session_start();

  #if accessing booking directly without session visitor id, redirect to login
  if (empty($_SESSION["visitorID"])) {
    header("Location: index.php");
    die();
  } else {
    $database = new crud_db();
    $result = $database -> select_data("Booking", $_SESSION['visitorID']);
  }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>All Bookings</title>
    <link rel="stylesheet" href="..\..\style.css">
    <script type="text/javascript">
       function delete_booking(element) {
         if (confirm("Are you sure want to delete this booking?")) {
           return true;
         }
         else {
           return false;
         }
       }
     </script>
    <script type="text/javascript" src="..\..\js\hidenav.js"></script>
  </head>
  <body>
      <div class="header">
        <div id="navigation">
          <ul class="nav">
            <li class="nav"><a class="nav" href="..\..\index.html">Home</a></li>
            <li class="nav"><a class="nav" href="book.php">Book a Visit</a></li>
            <li class="nav"><a class="navActive" href="bookings.php">View Bookings</a></li>
            <li class="nav" style="float:right"><a class="nav" href="..\admin\manage.php">Admin</a></li>
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
        Below you can find the bookings you made.
      </div>

      <div class="table_style">
        <table>
          <!-- <h2>Bookings for <?php print($_SESSION['visitorName']) ?></h2> -->
          <span id="create"><button type="button" onclick=location.href="book.php">Create a new Booking</button></span>

          <tr>
            <th>Ticket ID</th>
            <th>Visiting Site</th>
            <th>Visiting On</th>
            <th>Action</th>
          </tr>
           <?php
              // fetch
              while ($row = $result->fetch_assoc())
              {
                 // build table
                 print( "<tr>" );
                 print('<td>'.$row['ticketID'].'</td>');
                 print('<td>'.$row['siteName'].'</td>');
                 // print('<td>'.$row['entryDateTime'].'</td>');
                 echo '<td>'; echo date("Y-m-d", strtotime($row["entryDateTime"])); echo '</td>';
                 print('<td width=250>');
                 print('<button type="button" onclick=location.href="php/read_booking.php?ticketID='.$row['ticketID'].'">Read</button>');
                 print('<button type="button" onclick=location.href="update_booking.php?ticketID='.$row['ticketID'].'">Update</button>');
                 print('<a onclick="return delete_booking()" href="php/delete_booking.php?ticketID='.$row['ticketID'].'"><button type="button">Delete</button></a>');
                 print('</td>');
                 print("</tr>");
              } // end while
           ?>
        </table>
      </div>
   </body>
</html>
