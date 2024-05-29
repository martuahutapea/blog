<!-- Header -->
<?php include "includes/admin_header.php" ?>

    <?php

    if(isset($_SESSION['username'])){
       $username = $_SESSION['username'];

       $query = "SELECT * FROM users WHERE username = '{$username}'";

        // Sending the query
       $select_user_profile = mysqli_query($connection, $query);

       while($row = mysqli_fetch_array($select_user_profile)){
        $user_id = $row ['user_id'];
        $username = $row ['username'];
        $user_password = $row ['user_password'];
        $user_firstname = $row ['user_firstname'];
        $user_lastname = $row ['user_lastname'];       
        $user_email = $row ['user_email'];
        // $user_role = $row ['user_role'];
       }
    }

?>



<?php


    if(isset($_POST['edit_user'])){
            

        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];

        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        // $post_image = $_FILES['image']['name'];
        // $post_image_tmp = $_FILES['image']['tmp_name']; // The temporary file is not stored to the database yet until the user submit the submit button.


        // move_uploaded_file($post_image_tmp, "../images/$post_image"); //This will move the temporary image to our folder
        $query = "UPDATE users SET";
        $query .=" user_firstname ='{$user_firstname}', ";
        $query .=" user_lastname = '{$user_lastname}' , ";
        $query .=" username ='{$username}' , ";
        $query .=" user_email ='{$user_email}' , "; 
        $query .=" user_password ='{$user_password}'  ";
        $query .=" WHERE username = '{$username}' ";

        // Send the query
        $edit_user_query = mysqli_query($connection,$query);

        confirmQuery($edit_user_query) ;

    
}









?>




    <div id="wrapper">

<!-- Navigation -->
<?php include "includes/admin_navigation.php" ?>



        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        

                    <h1 class="page-header">
                            Profile
                            <small><?php echo $_SESSION['username'] ?></small>
                    </h1>


                    
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
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
    </div>

</form>



                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


<!-- Footer -->
<?php include "includes/admin_footer.php" ?>
