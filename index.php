<?php 
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php";
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8 clearfix">             

            <?php
                $per_page = 2;
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }else{
                    $page ="";
                }

                if($page=="" || $page==1){
                    $page_1 = 0;
                }else{
                    $page_1 = ($page * $per_page) - $per_page;
                }

                // Query to find out how many post database has
                $post_query_count = "SELECT * FROM posts";
                $find_count = mysqli_query($connection, $post_query_count);    
                $count = mysqli_num_rows($find_count);
                $count = (ceil($count / $per_page));

                // Select posts from database
                $query = "SELECT * FROM posts LIMIT $page_1, $per_page";
                $select_all_posts_query = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 200);
                    $post_status = $row['post_status'];

                    if($post_status == 'published'){?>
                
                <h1 class="page-header">
                Insights on tech from my blog.
                    <!-- <small>It'sMIHH  Posts</small> -->
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id;?>">   <?php echo $post_title?>  </a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author;?>&p_id=<?php echo $post_id;?>">  <?php echo $post_author;?>  </a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date;?> </p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id;?>">
                    <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="" style="max-width: 90%; max-height: 70%;">
                </a>
                
                <hr>
                <div style="max-width: 100%;">
                <?php
                // Define the maximum number of words to display
                $max_words = 20;

                // Use the substr function to extract the first $max_words words from the post_content
                $words = explode(' ', $post_content);
                $excerpt = implode(' ', array_slice($words, 0, $max_words));

                // Add an ellipsis to the end of the excerpt if it was truncated
                if (strlen($post_content) > $max_words) {
                    $excerpt.= '...';
                }
              ?>
                <p><?php echo $excerpt;?></p>
                <p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                </p>
                </div>
                <hr>
                <br>

                <?php } }?>  <!-- close the while and the if statements loop in here -->


            </div>
            
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>


            </div>
            <!-- /.row -->
            <hr>

            <!-- Pagination -->
            <ul class="pager">
            <?php
                for($i =1; $i <= $count; $i++){

                //Pgaination Background
                if($i == $page){
                    echo "<li><a class='active_link' href='index.php?page={$i}'> {$i} </a></li>";
                }else{
                    echo "<li><a href='index.php?page={$i}'> {$i} </a></li>";
                }
                    
                }
           ?>
            </ul>

    </div>

<?php include "includes/footer.php"?>