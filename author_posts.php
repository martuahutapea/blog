<?php session_start(); ?>
<?php include "includes/header.php"?>
<?php include "includes/db.php"?>


    <!-- Navigation -->
    
    <?php include "includes/navigation.php"?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">


            <!-- Blog Entries Column -->
            <div class="col-md-8">
            

            <?php

             if(isset($_GET['p_id'])){
                $the_post_id =$_GET['p_id'];
                $the_post_author =$_GET['author'];
             }

                $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}'"; //to select from the table that we want in database
                $select_all_posts_query = mysqli_query($connection,$query);


                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
            
             ?><!-- Close the php tag here -->





                <!-- Page header -->
                <!-- <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1> -->


                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>">   <?php echo $post_title; ?>  </a>
                </h2>
                <p class="lead">
                    All Post by <?php echo $post_author; ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?> </p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p>
                    <?php echo $post_content; ?>
                </p>
    
                <hr>
                <br>

                <?php } ?>  <!-- close the while loop in here -->





            <!-- Blog Comments -->
                <?php
                    if(isset($_POST['create_comment'])){

                        $the_post_id = $_GET['p_id'];

                        $comment_author = $_POST['$comment_author'];
                        $comment_email = $_POST['$comment_email'];
                        $comment_content = $_POST['$comment_content'];

                        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content) ){
                            

                        // Create a query to insert
                        $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
                    
                        // Send Query
                        $create_comment_query = mysqli_query($connection, $query);  
                            if(!$create_comment_query){
                                die('QUERY FAILED' . mysqli_error($connection));
                            }

                        // Create a query to update the table comment_count
                        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1  WHERE post_id = $the_post_id";
                        // Send Query
                        $update_comment_count = mysqli_query($connection,$query);
                        
// confirmQuery($update_comment_count);
// echo "Comment Created!";
}else{
    // echo "<span class='error'>Please fill out all fields.</span>";
    echo "<script>alert('Fields cannot be empty!')</script>";
}

                       
    }
?>






        </div>
            <hr>

            <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php"?>


            


            </div>
            <!-- /.row -->
            <hr>


<?php include "includes/footer.php"?>
















                <!-- Second Blog Post -->
                <!-- <h2>
                    <a href="#">Blog Post Title</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">Start Bootstrap</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:45 PM</p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam, quasi, fugiat, asperiores harum voluptatum tenetur a possimus nesciunt quod accusamus saepe tempora ipsam distinctio minima dolorum perferendis labore impedit voluptates!</p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr> -->


                <!-- Third Blog Post -->
                <!-- <h2>
                    <a href="#">Blog Post Title</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">Start Bootstrap</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:45 PM</p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, voluptates, voluptas dolore ipsam cumque quam veniam accusantium laudantium adipisci architecto itaque dicta aperiam maiores provident id incidunt autem. Magni, ratione.</p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr> -->









                <!-- Pager -->
                <!-- <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div> -->