<?php 
session_start(); 
include "includes/header.php";
include "includes/db.php";
include "includes/navigation.php";
?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">


            <!-- Blog Entries Column -->
            <div class="col-md-8">
            

            <?php

             if(isset($_GET['p_id'])){
                $the_post_id =$_GET['p_id'];

                $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
                $send_query = mysqli_query($connection, $view_query);

                // Check the query
                if(!$send_query){
                    die("query failled" . mysqli_error($connection));
                }

                $query = "SELECT * FROM posts WHERE post_id = $the_post_id"; //to select from the table that we want in database
                $select_all_posts_query = mysqli_query($connection,$query);


                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
            
             ?><!-- Close the php tag here -->
             
             <div>
             <h2>
                <a href="#">   <?php echo $post_title; ?>  </a>
                </h2>
                    <p class="lead">
                        by <a href="index.php">  <?php echo $post_author; ?>  </a>
                    </p>
                    <p>
                        <span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?> 
                    </p>
                <hr>
                
                    <img class="img-responsive" src='images/<?= $post_image; ?>' alt=''>
                <hr>
                    <p style="max-width: 100%; max-height: 100%;">
                        <?php echo $post_content; ?>
                    </p>
    
                <hr>
                <br>
             </div>

                

                <?php }

             }else{
                header("Location: index.php");
             }
             ?>  





            <!-- Blog Comments -->
            <?php
                if (isset($_POST['create_comment'])) {
                    $the_post_id = $_GET['p_id'];
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                    if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                        $comment_author = mysqli_real_escape_string($connection, $comment_author);
                        $comment_email = mysqli_real_escape_string($connection, $comment_email);
                        $comment_content = mysqli_real_escape_string($connection, $comment_content);

                        $query_comments = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ($the_post_id, '$comment_author', '$comment_email', '$comment_content', 'unapproved', now())";
                        $create_comment_query = mysqli_query($connection, $query_comments);

                        if ($create_comment_query) {
                            echo "Comment has been submitted and is awaiting moderation.";
                        } else {
                            echo "Error: " . mysqli_error($connection);
                        }
                    } else {
                        echo "All fields are required.";
                    }
                }
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="Author">Author</label>
                            <input type="text" name="comment_author" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="comment_email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="comment">Your comment is...</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <hr>

                <!-- Posted Comments -->
                <?php
                $query = "SELECT * FROM comments WHERE comment_post_id = '{$the_post_id}' AND comment_status = 'approved' ORDER BY comment_id DESC";
                $select_comments_query = mysqli_query($connection, $query);

                if (!$select_comments_query) {
                    die('QUERY FAILED: ' . mysqli_error($connection));
                }

                while ($row = mysqli_fetch_assoc($select_comments_query)) {
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
                ?>
                    <!-- Comment -->
                    <div class="media">
                        <a href="#" class="pull-left">
                            <img class="media-object" src="http://placehold.it/64x64" alt="" width="100%">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author; ?>
                                <small><?php echo $comment_date; ?></small>
                            </h4>
                            <?php echo $comment_content; ?>
                        </div>
                    </div>
                <?php
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