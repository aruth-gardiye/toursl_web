<?php

#Learning material
#https://www.w3schools.com/php/php_oop_constructor.asp
#https://www.w3schools.com/php/php_mysql_create.asp
#https://www.phptutorial.net/php-tutorial/php-implode/

class crud_db{
  private static $host = "localhost";
  private static  $user = "agardiyepunchihewa";
  private static  $pass = "mysql123";
  private static $db = "db_agardiyepunchihewa";
  public $conn;

  function __construct(){
    $this->conn=mysqli_connect(crud_db::$host, crud_db::$user, crud_db::$pass, crud_db::$db);
  }

  #SELECT DATA
  function select_data($table, $id){
    #get all data from a table
    if ($id == -1){
      $query="SELECT * FROM $table";
      $result=mysqli_query($this->conn,$query);
      return $result;
    }
    #get specific row from a table
    if ($id != -1){
      #if table name is 'site'
      if ($table == 'Site'){
        $query="SELECT * FROM $table WHERE siteID = $id";
        $result=mysqli_query($this->conn,$query);
        $row=$result->fetch_array(MYSQLI_ASSOC);
        return $row;
        }

      #if table name is 'visitor'
      if ($table == 'Visitor'){
        $query="SELECT * FROM $table WHERE visitorContact = $id";
        $result=mysqli_query($this->conn,$query);
        $row=$result->fetch_array(MYSQLI_ASSOC);
        return $row;
        }

      if ($table == 'Booking'){
        $query="SELECT Booking.ticketID, Booking.siteID, Site.siteName,
        Booking.visitorID, Booking.entryDateTime FROM Booking
        INNER JOIN Site ON Booking.siteID = Site.siteID
        WHERE Booking.visitorID = $id";
        $result=mysqli_query($this->conn,$query);
        return $result;
        }

      if ($table == 'Booking_edit'){
        $query="SELECT Booking.ticketID, Booking.siteID, Site.siteName,
        Booking.visitorID, Booking.entryDateTime FROM Booking
        INNER JOIN Site ON Booking.siteID = Site.siteID
        WHERE Booking.ticketID = $id";
        $result=mysqli_query($this->conn,$query);
        $row=$result->fetch_array(MYSQLI_ASSOC);
        return $row;
        }

        if ($table == 'Booking_view'){
          $query="SELECT Booking.ticketID, Booking.siteID,
          Site.siteID, Site.siteName, Site.priceFrom, Booking.visitorID, Visitor.visitorID,
          Visitor.visitorName, Visitor.visitorContact, Booking.entryDateTime FROM Booking
          INNER JOIN Site ON Booking.siteID = Site.siteID
          INNER JOIN Visitor ON Booking.visitorID = Visitor.visitorID
          WHERE Booking.ticketID = $id";
          $result=mysqli_query($this->conn,$query);
          $row=$result->fetch_array(MYSQLI_ASSOC);
          return $row;
          }
    }mysqli_close($this->conn);
  }

  #INSERT or UPDATE DATA
  function insert_data($table, $id, $array){

    #get field name and value from form array
    function return_key_value($v, $k){
      return $k . '=' . "'$v'";
    }

    #implodes array and gets the table columns and values from array
    $data=implode(',', array_map('return_key_value',  $array,  array_keys($array) ));

    #insert new data
    if ($id == -1){
      $query="INSERT INTO $table SET $data";
  		return mysqli_query($this->conn,$query) or die("Query error ".mysqli_error($this->conn));
    }

    #update existing data
    if($id != -1){
        if ($table == 'Site'){
          $query="UPDATE $table SET $data WHERE siteID = $id";
          return mysqli_query($this->conn,$query) or die("Query error ".mysqli_error($this->conn));
        }

        if ($table == 'Booking'){
          $query="UPDATE $table SET $data WHERE ticketID = $id";
          return mysqli_query($this->conn,$query) or die("Query error ".mysqli_error($this->conn));
        }
      }
      mysqli_close($this->conn);
    }

    #delete exisiting data
    function delete_data($table, $id){
      if ($table == 'Site'){
        $query="DELETE FROM $table WHERE siteID= $id";
    		return mysqli_query($this->conn,$query) or die("Query error ".mysqli_error($this->conn));
      }

      if ($table == 'Booking'){
        $query="DELETE FROM $table WHERE ticketID= $id";
    		return mysqli_query($this->conn,$query) or die("Query error ".mysqli_error($this->conn));
      }
      mysqli_close($this->conn);
    }
  }


 ?>
