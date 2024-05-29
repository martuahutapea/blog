<?php

// Check if the functions exists
if(!function_exists('user_online')){
// Function to display users online
function user_online(){
    if(isset($_GET['onlineusers'])){


    global $connection;
    if(!$connection){
        session_start();
        include("../includes/db.php");

        // Catch the session
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 5;
        $time_out = $time - $time_out_in_seconds;


        // Query
        $query = "SELECT * FROM users_online  WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        // Count how many users online
        $count = mysqli_num_rows($send_query);


        // Funtion to check if there is no online user then set the session & time to keep in track 
        if($count == NULL){
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time' )");
        }else{
            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
        }

        $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
        if (!$users_online_query) {
            echo "Error: ". mysqli_error($connection);
            exit;
        }
        echo $count_user = mysqli_num_rows( $users_online_query );
                

    }
    }
    
    }//get request isset()
}

// Called the function
user_online();


if(!function_exists('confirmQuery')){
    function confirmQuery($result){
        //Function to check if the query failled load to database and give  an error message if it did.
        global $connection;
        if(!$result){
            die("Querry Failled ." . mysqli_error($connection));
        }
    }
}


if(!function_exists('insertCategories')){
    function insertCategories(){

        global $connection;

        if(isset($_POST['submit'])){
            $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
            echo "This field  should not be empty";
        } else{
            $query = "INSERT INTO categories (cat_title) VALUES ('{$cat_title}') ";
            $create_category_query = mysqli_query($connection,$query);

            if(!$create_category_query){
                die("QUERY FAILED".mysqli_error($connection)); 
            }
        }
    }

    }
}



if(!function_exists('findAllCategories')){
    function findAllCategories(){

        global $connection;

            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query ($connection,$query);


            while($row = mysqli_fetch_assoc($select_categories)){
            $cat_id = $row ['cat_id'];
            $cat_title = $row ['cat_title'];

            echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td><a href='categories.php?delete={$cat_id}'> Delete </a></td>";
            echo "<td><a href='categories.php?update={$cat_id}'> Edit </a></td>";
            echo "</tr>";
            }
        }
    }



if(!function_exists('deleteCategories')){
// Delete Categories

    function deleteCategories(){
        global $connection;
        
        if(isset($_GET['delete'])){
            $the_cat_id = $_GET['delete'];
                $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
                $delete_query = mysqli_query($connection,$query);
                header("Location: categories.php"); //This command will refresh the page
        }
    }
}
?>