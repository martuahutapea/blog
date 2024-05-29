<table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Comments</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>In Response to</th>
                                <th>Date</th>
                                <th>Approve</th>
                                <th>Unapprove</th>                             
                                <th>Delete</th>
                                
                                
                                                                                         
                            </tr>
                        </thead>
                    

                        <tbody>


<!-- Create A query to list the date from the database -->
<?php

    $query = "SELECT * FROM comments"; //First is to select the table from the datbase that we need to querry
    $select_comments = mysqli_query ($connection,$query);


    while($row = mysqli_fetch_assoc($select_comments)){
        $comment_id = $row ['comment_id'];
        $comment_post_id = $row ['comment_post_id'];
        $comment_author= $row ['comment_author'];
        $comment_content = $row ['comment_content'];
        $comment_email = $row ['comment_email'];       
        $comment_status = $row ['comment_status'];
        $comment_date = $row ['comment_date'];



//This will call the value  of Table and display it on the post page. 
        echo "<tr>";
            echo "<td> $comment_id  </td>";
            echo "<td> $comment_author  </td>";
            echo "<td> $comment_content  </td>";
            echo "<td> $comment_email </td>";



            // $query = "SELECT * FROM categories WHERE cat_id = $post_category_id ";
            // $select_categories_id = mysqli_query ($connection,$query);


            // while($row = mysqli_fetch_assoc($select_categories_id)){
            // $cat_id = $row ['cat_id'];
            // $cat_title = $row ['cat_title'];


            // echo "<td> {$cat_title} </td>";
            // }





            echo "<td> $comment_status </td>";

            
            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            $select_post_id_querry = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($select_post_id_querry)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                    echo "<td> <a href='../post.php?p_id=$post_id'> $post_title </a></td>";

            }



            echo "<td> $comment_date </td>";
            echo "<td> <a href='comments.php?approve=$comment_id'> Approve <a></td>";
            echo "<td> <a href='comments.php?unapprove=$comment_id'> Unapprove <a></td>";
            echo "<td> <a href='comments.php?delete=$comment_id'> Delete <a></td>";
            
            echo "</tr>";
    
    }
?>


    </tbody>
</table>

<?php



    //Update approved Comments
    if(isset($_GET['approve'])){

        $the_comment_id = $_GET['approve'];

        //Querry to delete the post from the database
        $query = "UPDATE comments SET comment_status = 'approved' WHERE  comment_id = $the_comment_id";
        $approve_comment_query = mysqli_query($connection, $query);


    }





    //Update unapproved Comments
    if(isset($_GET['unapprove'])){

        $the_comment_id = $_GET['unapprove'];

        //Querry to delete the post from the database
        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id ";
        $unapprove_comment_query = mysqli_query($connection, $query);
        // header("Location: comments.php");

    }




    //Delete Comments
    if(isset($_GET['delete'])){

        $the_comment_id = $_GET['delete'];

        //Querry to delete the post from the database
        $query = "DELETE FROM comments WHERE  comment_id = {$the_comment_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: comments.php");

    }
?>



