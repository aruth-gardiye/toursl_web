<?php

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Admin Login</title>
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
       Welcome
     </div>
     <div class="messege text">
       Please login to continue
     </div>

     <div class="parent">
       <div class="form">
         <h1>Enter</h1>
         <form method="post" action="manage.php" >
           <div class="form_input">
             <input type="text" name="user_name" placeholder="" value="admin" required>
             <span></span>
             <label for="user_name">User Name</label>
           </div>
           <div class="form_input">
             <input type="password" name="user_pass" placeholder="" value="password" required>
             <span></span>
             <label for="user_pass">Password</label>
           </div>
           <input type="submit" name="submit" value="Enter">
         </form>
       </div>
     </div>
   </body>
 </html>
