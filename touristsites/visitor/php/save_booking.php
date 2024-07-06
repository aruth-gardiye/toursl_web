<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("../../php/crud_db.php");
$database = new crud_db();

session_start();

#getting form input from _POST and putting into an array
$inputlist = array(
  "visitorID" => $_SESSION["visitorID"],
  "siteID" => trim(htmlspecialchars($_POST["visitor_site"])),
  "entryDateTime" => trim(htmlspecialchars($_POST["visitor_date"]))
);

if ($_SESSION['Booking_action'] == "insert") {
  $result = $database -> insert_data("Booking", -1, $inputlist);
  $_SESSION["new_ticketID"] = mysqli_insert_id($database -> conn);
  $row = $database -> select_data("Booking_edit", $_SESSION["new_ticketID"]);

  $new_date_wo_time = date("Y-m-d", strtotime($inputlist['entryDateTime']));

  print("

  <!DOCTYPE html>
  <html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
        <title>Updated Record</title>
        <link rel=\"stylesheet\" href=\"..\..\..\style.css\">
    </head>
    <body>
      <div class=\"header\">
        <div id=\"navigation\">
          <ul class=\"nav\">
            <li class=\"nav\"><a class=\"nav\" href=\"..\..\..\index.html\">Home</a></li>
            <li class=\"nav\"><a class=\"nav\" href=\"..\book.php\">Book a Visit</a></li>
            <li class=\"nav\"><a class=\"navActive\" href=\"..\bookings.php\">View Bookings</a></li>
            <li class=\"nav\" style=\"float:right\"><a class=\"nav\" href=\"..\..\admin\manage.php\">Admin</a></li>
          </ul>
          <div align=\"center\" class=\"navborder\"></div>
        </div>
      </div>

      <div class=\"messege\">
        Welcome {$_SESSION["visitorName"]}
        <a href=\"logout.php\">
          <button type=\"button\" class=\"button\">Log Out</button>
        </a>
      </div>
      <div class=\"messege text\">
        The following information has been saved in to the database:
      </div>

      <div class=\"table_style\">
        <table>
          <tr>
            <th>Ticket ID</th>
            <th>Visitor ID</th>
            <th>Visiting Site</th>
            <th>Visiting On</th>
          </tr>
           <td>{$_SESSION['new_ticketID']}</td>
           <td>{$row['visitorID']}</td>
           <td>{$row['siteName']}</td>
           <td>{$new_date_wo_time}</td>
           </tr>
        </table>
        <span id=\"create\"><button type=\"button\" onclick=location.href=\"../bookings.php\">Return to Bookings</button></span>
    </body>
  </html>");

  unset($_SESSION["new_ticketID"]);
  unset($_SESSION["booking_action"]);
  die();
}

if ($_SESSION['Booking_action'] == "update") {

  print("
  <!DOCTYPE html>
  <html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
        <title>Updated Record</title>
        <link rel=\"stylesheet\" href=\"..\..\..\style.css\">
    </head>
    <body>
      <div class=\"header\">
        <div id=\"navigation\">
          <ul class=\"nav\">
            <li class=\"nav\"><a class=\"nav\" href=\"..\..\..\index.html\">Home</a></li>
            <li class=\"nav\"><a class=\"nav\" href=\"..\book.php\">Book a Visit</a></li>
            <li class=\"nav\"><a class=\"navActive\" href=\"..\bookings.php\">View Bookings</a></li>
            <li class=\"nav\" style=\"float:right\"><a class=\"nav\" href=\"..\..\admin\manage.php\">Admin</a></li>
          </ul>
          <div align=\"center\" class=\"navborder\"></div>
        </div>
      </div>
    ");

  $new_date = getDate(strtotime($inputlist['entryDateTime']));
  $old_date = getDate(strtotime($_SESSION['old_booking_entryDateTime']));

  $new_date_wo_time = date("Y-m-d", strtotime($inputlist['entryDateTime']));
  $old_date_wo_time = date("Y-m-d", strtotime($_SESSION['old_booking_entryDateTime']));

  if($inputlist['siteID'] == $_SESSION['old_booking_siteID'] && $new_date == $old_date){
    print("

      <div class=\"messege\">
        Welcome {$_SESSION["visitorName"]}
        <a href=\"logout.php\">
          <button type=\"button\" class=\"button\">Log Out</button>
        </a>
      </div>
      <div class=\"messege text\">
        Nothing to change.
      </div>

      <span align=\"center\" class=\"table_style\" id=\"create\"><button type=\"button\" onclick=location.href=\"../bookings.php\">Return to Bookings</button></span>
      </body>
    </html>");

    unset($_SESSION["ticketID"]);
    unset($_SESSION["booking_action"]);
    unset($_SESSION["old_booking_siteID"]);
    unset($_SESSION["old_booking_siteName"]);
    unset($_SESSION["old_booking_entryDateTime"]);
    die();

  }else{
      $database -> insert_data("Booking", $_SESSION['ticketID'], $inputlist);
      $row = $database -> select_data("Booking_edit", $_SESSION["ticketID"]);

      if($row['siteID'] != $_SESSION["old_booking_siteID"] && $row['entryDateTime'] != $_SESSION["old_booking_entryDateTime"]){
        print("

          <div class=\"messege\">
            Welcome {$_SESSION["visitorName"]}
            <a href=\"logout.php\">
              <button type=\"button\" class=\"button\">Log Out</button>
            </a>
          </div>
          <div class=\"messege text\">
            The following information has been saved in to the database:
          </div>

          <div class=\"table_style\">
            <table>
              <tr>
                <th>Old Visiting Site</th>
                <th>New Visiting Site</th>
                <th>Old Visiting Date</th>
                <th>New Visiting Date</th>
              </tr>
               <td>{$_SESSION["old_booking_siteName"]}</td>
               <td>{$row['siteName']}</td>
               <td>{$old_date_wo_time}</td>
               <td>{$new_date_wo_time}</td>
               </tr>
            </table>
            <span class=\"table_style\" id=\"create\"><button type=\"button\" onclick=location.href=\"../bookings.php\">Return to Bookings</button></span>
          </body>
        </html>");
      }

      elseif($row['siteID'] != $_SESSION["old_booking_siteID"]){
        print("

          <div class=\"messege\">
            Welcome {$_SESSION["visitorName"]}
            <a href=\"logout.php\">
              <button type=\"button\" class=\"button\">Log Out</button>
            </a>
          </div>
          <div class=\"messege text\">
            The following information has been saved in to the database:
          </div>

          <div class=\"table_style\">
            <table>
              <tr>
                <th>Old Visiting Site</th>
                <th>New Visiting Site</th>
              </tr>
               <td>{$_SESSION["old_booking_siteName"]}</td>
               <td>{$row['siteName']}</td>
               </tr>
            </table>
            <span class=\"table_style\" id=\"create\"><button type=\"button\" onclick=location.href=\"../bookings.php\">Return to Bookings</button></span>
          </body>
        </html>");
      }

      elseif($row['entryDateTime'] != $_SESSION["old_booking_entryDateTime"]){
        print("

          <div class=\"messege\">
            Welcome {$_SESSION["visitorName"]}
            <a href=\"logout.php\">
              <button type=\"button\" class=\"button\">Log Out</button>
            </a>
          </div>
          <div class=\"messege text\">
            The following information has been saved in to the database:
          </div>

          <div class=\"table_style\">
            <table>
              <tr>
                <th>Old Visiting Date</th>
                <th>New Visiting Date</th>
              </tr>
               <td>{$old_date_wo_time}</td>
               <td>{$new_date_wo_time}</td>
               </tr>
            </table>
            <span class=\"table_style\" id=\"create\"><button type=\"button\" onclick=location.href=\"../bookings.php\">Return to Bookings</button></span>
          </body>
        </html>");
      }

      unset($_SESSION["ticketID"]);
      unset($_SESSION["booking_action"]);
      unset($_SESSION["old_booking_siteID"]);
      unset($_SESSION["old_booking_siteName"]);
      unset($_SESSION["old_booking_entryDateTime"]);
      die();
  }
}
?>
