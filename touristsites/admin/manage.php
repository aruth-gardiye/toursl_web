<?php

  session_start();
  define("uname", "admin");
  define("pass", "password");

  #if accessing booking directly without session logged or password
  if (empty($_SESSION["AdminLogged"]) && !empty($_POST['user_name']) && !empty($_POST['user_pass'])) {
    if(uname != $_POST['user_name'] || pass != $_POST['user_pass']){
      header("Location: login.php");
      die();
    }elseif (uname == $_POST['user_name'] && pass == $_POST['user_pass']) {
      $_SESSION["AdminLogged"] = "Yes";
    }
  }elseif (empty($_SESSION["AdminLogged"]) && (empty($_POST['user_name']) || empty($_POST['user_pass']))) {
    header("Location: login.php");
    die();
  }elseif (!empty($_SESSION["AdminLogged"])) {
  }else{
      header("Location: login.php");
      die();
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
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
      Admin Panel
    </div>
    <div class="parent">
      <div class="form">
        <br>
        <form action="" method="post">
          <a href="create_site.php">
            <input type="button" class="button" value="Create Site"></input>
          </a>
          <a href="get_sites.php">
            <input type="button" class="button" value="Manage Sites"></input>
          </a>
        </form>
      </div>
    </div>
  </body>
</html>
