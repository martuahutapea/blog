<?php include "db.php"; ?>
<?php session_start(); ?>


<?php

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Security SQL injection 
        $username = mysqli_real_escape_string( $connection, $username );
        $password = mysqli_real_escape_string( $connection, $password);

        //  Checking username and password from database
        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $select_users_query = mysqli_query($connection, $query);

        // Chekc the Connection
        if( !$select_users_query ) {
            die("QUERY FAILED " . mysqli_error($connection));
        }

        //  If user exists get the associated data of that user
        while($row =  mysqli_fetch_assoc($select_users_query)){

            $db_user_id = $row['user_id'];
            $db_username = $row['username'];
            $db_user_password = $row['user_password'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];
        }

// $password = crypt($password, $db_user_password);
        
        if($username !== $db_username && $password !== $db_user_password){
            header("Location: ../index.php");
        }

        //  Password verification
        elseif(password_verify($password,$db_user_password)){
            // Set the Session 
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;   
            $_SESSION['user_role'] = $db_user_role;

            header("Location: ../admin");

        }else{
            header("Location: ../index.php");
        }
  
    }

?>