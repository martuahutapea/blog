<?php

    if(isset($_POST['create_user'])){
        

        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];

        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];


        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

        // $post_image = $_FILES['image']['name'];
        // $post_image_tmp = $_FILES['image']['tmp_name']; // The temporary file is not stored to the database yet until the user submit the submit button.

        // $post_tags = $_POST['post_tags'];
        // $post_content = $_POST['post_content'];
        // $post_date = date('d-m-y');

        
      

    //     move_uploaded_file($post_image_tmp, "../images/$post_image"); //This will move the temporary image to our folder



        //We need a querry to insert the data from the user to the database.
        $query="INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) VALUES ('{$user_firstname}','{$user_lastname}', '{$user_role}' ,'{$username}','{$user_email}', '{$user_password}')";

        // Test the Querry
        if(!$query){
            die("Cannot Add the User " .mysqli_error($connection));
        }
     
        $create_user_query = mysqli_query($connection,$query);

        // Called the Function
        confirmQuery($create_user_query);

        echo "<div class='alert alert-success'>User Create Succesfully. <a href='users.php' class='btn btn-primary'>View User</a></div>";
        
        
    }

?>





<!-- The enctype in a form allow us to sending differnt form of data because we need a image to be uploaded -->
<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>


    <div class="form-group">
    <label> Select Roles:</label><br>       
        <select  name="user_role" id="">
            <option class="form-control" value="subscriber">Subscriber</option>
            <option class="form-option" value="admin">Admin</option>         
        </select>
    </div>



    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input width="100" type="file" class="form-file" name="image">
    </div> -->


    <div class="form-group">
        <label for="username">username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_content">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Create User">
    </div>
    
</form>