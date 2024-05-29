

<table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Change Role to Admin</th>
                                <th>Change Role to Subs</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <!-- <th>Date</th> -->
                                                                                         
                            </tr>
                        </thead>
                    

                        <tbody>


<!-- Create A query to list the date from the database -->
<?php

    $query = "SELECT * FROM users"; //First is to select the table from the datbase that we need to querry
    $select_users = mysqli_query ($connection,$query);


    while($row = mysqli_fetch_assoc($select_users)){
        $user_id = $row ['user_id'];
        $username = $row ['username'];
        $user_password = $row ['user_password'];
        $user_firstname = $row ['user_firstname'];
        $user_lastname = $row ['user_lastname'];       
        $user_email = $row ['user_email'];
        $user_image = $row ['user_image'];
        $user_role = $row ['user_role'];
        // $randSalt = $row ['randSalt'];



//This will call the value  of Table and display it on the post page. 
        echo "<tr>";
            echo "<td> $user_id  </td>";
            echo "<td> $username  </td>";
            echo "<td> $user_firstname </td>";
            echo "<td> $user_lastname </td>";



            // $query = "SELECT * FROM categories WHERE cat_id = $post_category_id ";
            // $select_categories_id = mysqli_query ($connection,$query);


            // while($row = mysqli_fetch_assoc($select_categories_id)){
            // $cat_id = $row ['cat_id'];
            // $cat_title = $row ['cat_title'];


            // echo "<td> {$cat_title} </td>";
            // }





            echo "<td> $user_email </td>";
            echo "<td> $user_role </td>";
            

            
            // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            // $select_post_id_querry = mysqli_query($connection,$query);

            // while($row = mysqli_fetch_assoc($select_post_id_querry)){
            //     $post_id = $row['post_id'];
            //     $post_title = $row['post_title'];
            //         echo "<td> Some title </title>";    
            //         echo "<a href='../post.php?p_id=$post_id'> $post_title </a></td>";

            // }

            // echo "<td> Some Title </td>";





            echo "<td> <a href='users.php?change_to_admin={$user_id}'> Admin <a></td>";
            echo "<td> <a href='users.php?change_to_subscriber={$user_id}'> Subscriber <a></td>";
            echo "<td> <a href='users.php?source=edit_user&edit_user={$user_id}'> Edit <a></td>";
            echo "<td> <a onClick=\"javascript: return confirm('Are you sure want to delete the user?')\" href='users.php?delete={$user_id}'> Delete <a></td>";
            
            echo "</tr>";
    
    }
?>


    </tbody>
</table>

<?php



    //Update Role to admin
    if(isset($_GET['change_to_admin'])){

        $the_user_id = $_GET['change_to_admin'];

        //Querry set the value of the column
        $query = "UPDATE users SET user_role = 'admin' WHERE  user_id = $the_user_id";
        $change_to_admin_query = mysqli_query($connection, $query);


    }





    //Update role to subscriber
    if(isset($_GET['change_to_subscriber'])){

        $the_user_id = $_GET['change_to_subscriber'];

        //Querry to delete the post from the database
        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id ";
        $change_to_subscriber_query = mysqli_query($connection, $query);
        // 

    }




    //Delete Comments
    if(isset($_GET['delete'])){

        $the_user_id = $_GET['delete'];

        //Querry to delete the post from the database
        $query = "DELETE FROM users WHERE  user_id = {$the_user_id}";
        $delete_user_query = mysqli_query($connection, $query);
    }
    
?>