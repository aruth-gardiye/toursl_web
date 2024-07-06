<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="..\..\style.css">
    <script type="text/javascript">
       function delete_site(element) {
         var result = confirm("Are you sure want to delete this site?");
         if (result) {
           $.post("delete_site.php", {siteID: element.value});
         }
       }
     </script>
    <script type="text/javascript" src="..\..\js\hidenav.js"></script>
  </head>
  <body>
      <?php
      include_once("../php/crud_db.php");

      $database = new crud_db();
      $result = $database -> select_data("Site", -1);
      ?>

      <div class="header">
        <div id="navigation">
          <ul class="nav">
            <li class="nav"><a class="nav" href="..\..\index.html">Home</a></li>
            <li class="nav"><a class="nav" href="..\visitor\index.php">Tourist Sites</a></li>
            <li class="nav" style="float:right"><a class="navActive" href="manage.php">Admin</a></li>
          </ul>
          <div align="center" class="navborder"></div>
        </div>
      </div>

      <div class="messege">
        <?php print("Welcome Admin"); ?>
        <a href="..\visitor\logout.php">
          <button type="button" class="button">Log Out</button>
        </a>
      </div>
      <div class="messege text">
        Below you can find the sites.
      </div>

      <div class="table_style">
        <table>
          <h2>Tourist Sites around Colombo</h2>
          <span id="create"><button type="button" onclick=location.href="create_site.php?">Create</button></span>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
          </tr>
           <?php
              // fetch
              while ($row = $result->fetch_assoc())
              {
                 // build table
                 print( "<tr>" );
                 print('<td>'.$row['siteID'].'</td>');
                 print('<td>'.$row['siteName'].'</td>');
                 print('<td width=250>');
                 print('<button type="button" onclick=location.href="read_site.php?id='.$row['siteID'].'">Read</button>');
                 print('<button type="button" onclick=location.href="update_site.php?id='.$row['siteID'].'">Update</button>');
                 print('<button type="button" value='.$row['siteID'].' onclick="delete_site(this)">Delete</button>');
                 print('</td>');
                 print("</tr>");
              } // end while
           ?>
        </table>
      </div>
   </body>
</html>
