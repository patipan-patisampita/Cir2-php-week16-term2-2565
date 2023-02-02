<?php 
    $host = "localhost";
    $username = "root";
    $password = "12345678";
    $database = "db_food";

    $con = mysqli_connect("$host","$username","$password","$database");
    mysqli_set_charset($con,'utf8');

    if(!$con){
        print("Database not connextion");
    }
?>