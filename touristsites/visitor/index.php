<?php

session_start();

#if logged in redirect to booking
if(!empty($_SESSION["visitorID"])){
  header("Location: book.php");
  die();
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Enter</title>
    <link rel="stylesheet" href="..\..\style.css">
    <script type="text/javascript" src="..\..\js\hidenav.js"></script>
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
      Welcome
    </div>
    <div class="messege text">
      Please input your first name and phone number to continue
    </div>

    <div class="parent">
      <div class="form">
        <h1>Enter</h1>
        <form method="post" action="book.php" >
          <div class="form_input">
            <input type="text" name="visitor_name" placeholder="" value="John" required>
            <span></span>
            <label for="visitor_name">Name</label>
          </div>
          <div class="form_input">
            <input type="tel" name="visitor_phn" placeholder="" value="123456789" pattern="[0-9]{9}" required>
            <span></span>
            <label for="visitor_phn">Phone Number (123456789)</label>
          </div>
          <input type="submit" name="submit" value="Enter">
        </form>
      </div>
    </div>
  </body>
</html>
