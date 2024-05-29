<?php
// connect to databse with the elements that need
$db['db_host'] =  "localhost";
$db['db_user'] =  "root";
$db['db_pass'] =  "";
$db['db_name'] =  "blog";

    // To run the each variable and make the array in upper case.
    foreach($db as $key => $value){
        define(strtoupper($key), $value);
    }



// Check the Connection 
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$connection){   
        die("Database connection failed: " . mysqli_connect_error());       
     } //else{
    //     echo "we are connected";
    // }

?>