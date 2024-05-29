<?php

    if(isset($_GET['edit_user'])){
        $the_user_id =  $_GET['edit_user'];

        $query = "SELECT * FROM users WHERE user_id = $the_user_id"; //First is to select the table from the datbase that we need to querry
        $select_users_query = mysqli_query ($connection,$query);


    while($row = mysqli_fetch_assoc($select_users_query)){
        $user_id = $row ['user_id'];
        $username = $row ['username'];
        $user_password = $row ['user_password'];
        $user_firstname = $row ['user_firstname'];
        $user_lastname = $row ['user_lastname'];       
        $user_email = $row ['user_email'];
        $user_image = $row ['user_image'];
        $user_role = $row ['user_role'];
    }




    if(isset($_POST['edit_user'])){
        

        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];

        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        // $post_image = $_FILES['image']['name'];
        // $post_image_tmp = $_FILES['image']['tmp_name']; // The temporary file is not stored to the database yet until the user submit the submit button.

        // $post_tags = $_POST['post_tags'];
        // $post_content = $_POST['post_content'];
        // $post_date = date('d-m-y');

        
        if(!empty($user_password)){
            $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
            $get_user_query = mysqli_query($connection, $query_password);
            confirmQuery($get_user_query) ;

            // Bring the user password
            $row = mysqli_fetch_array($get_user_query);

            $db_user_password = $row['user_password'];

                if($db_user_password != $user_password){
                    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
                }

                $query = "UPDATE users SET";
                $query .=" user_firstname ='{$user_firstname}', ";
                $query .=" user_lastname = '{$user_lastname}' , ";
                $query .=" user_role = '{$user_role}' , "; 
                $query .=" username ='{$username}' , ";
                $query .=" user_email ='{$user_email}' , "; 
                $query .=" user_password ='{$hashed_password}'  ";
                $query .=" WHERE user_id = '{$the_user_id}' ";

            // Send the query
            $edit_user_query = mysqli_query($connection,$query);

            confirmQuery($edit_user_query) ;
            echo "<div class='alert alert-success'>User Updpated Succesfully. <a href='users.php' class='btn btn-primary'>View User</a></div>";
        }
    }
}else{
    header("Location: index.php");
}



?>





<!-- The enctype in a form allow us to sending differnt form of data because we need a image to be uploaded -->
<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" value="<?php echo $user_firstname ?>" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input value="<?php echo $user_lastname ?>" type="text" class="form-control" name="user_lastname">
    </div>


    <div class="form-group">
    <label> Select Roles:</label><br>       
        <select name="user_role" id="">
            <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>

        <?php 
            if($user_role == 'admin'){
                echo "<option  value='subscriber'> Subscriber </option>";
            }else{
                echo "<option  value='admin'> Admin </option>";
            }
            ?>

        </select>
    </div>



    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input width="100" type="file" class="form-file" name="image">
    </div> -->


    <div class="form-group">
        <label for="username">username</label>
        <input value="<?php echo $username ?>" type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_content">Email</label>
        <input value="<?php echo $user_email ?>" type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input value="" type="password" class="form-control" name="user_password">
    </div>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
    </div>
    
</form>