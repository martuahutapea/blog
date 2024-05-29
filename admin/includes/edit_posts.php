<?php

    if(isset($_GET['p_id'])){
        
    $the_post_id = $_GET['p_id'];

    }
    //First is to select the table from the datbase that we need to querry
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id"; 
    $select_posts_by_id = mysqli_query ($connection,$query);


    while($row = mysqli_fetch_assoc($select_posts_by_id)){
        $post_id = $row ['post_id'];       
        $post_author = $row ['post_author'];
        $post_title = $row ['post_title'];
        $post_category_id = $row ['post_category_id'];
        $post_status = $row ['post_status'];
        $post_image = $row ['post_image'];
        $post_content = $row ['post_content'];
        $post_tags = $row ['post_tags'];
        $post_comment_count = $row ['post_comment_count'];
        $post_date = $row ['post_date'];
    }



    if (isset($_POST['update_posts'])){

        $post_author = $_POST['post_author'];
        $post_title = mysqli_real_escape_string($connection, $_POST['title']);
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['image'] ['name'];
        $post_image_tmp = $_FILES['image'] ['tmp_name'];
        $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
        $post_tags = $_POST['post_tags'];
        

    move_uploaded_file($post_image_tmp, "../images/$post_image");

        if(empty($post_image)){
            $query = " SELECT * FROM posts WHERE post_id = $the_post_id";
            $select_image = mysqli_query($connection,$query);

            while ($row = mysqli_fetch_array($select_image)){
                $post_image = $row['post_image'];
            }
        }

        // $query = "UPDATE posts SET post_title='{$post_title}', post_category_id='{$post_category_id}', post_date=now(),  post_author='{$post_author}', post_status='{$post_status}', post_tags='{$post_tags}', post_content='{$post_content}', post_image='{$post_image}' WHERE post_id={the_post_id}"; 

           
        $query = "UPDATE posts SET ";
        $query .= "post_title ='{$post_title}',";
        $query .= "post_category_id = '{$post_category_id}',";
        $query .= "post_date = now(),"; 
        $query .= "post_author ='{$post_author}',";
        $query .= "post_status ='{$post_status}',"; 
        $query .= "post_tags ='{$post_tags}',";
        $query .= "post_content ='{$post_content}',"; 
        $query .= "post_image ='{$post_image}' "; 
        $query .= "WHERE post_id = {$the_post_id} "; 


        $update_posts = mysqli_query($connection,$query);

        confirmQuery($update_posts);
        
        echo "<div class='alert alert-success'>Post Updated. <a href='posts.php' class='btn btn-primary'>View All Posts</a></div>";
        
    }
    
    
?>




<!-- The enctype in a form allow us to sending differnt form of data because we need a image to be uploaded -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
    </div>


    
    <!-- For category id -->
    <div class="form-group">
        <label>Select Category:</label><br>       
            <select name="post_category" id="post_category">
            

<?php
$query = "SELECT * FROM categories";
$select_categories = mysqli_query ($connection,$query);

confirmQuery($select_categories);

while($row = mysqli_fetch_assoc($select_categories)){
$cat_id = $row ['cat_id'];
$cat_title = $row ['cat_title'];

echo "<option value='{$cat_id}'> {$cat_title} </option>";
}
?>

            </select>
    </div>





    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>



    <!-- Make Status dynamic -->
    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <select name="post_status" id="">
            <option value='<?php echo $post_status; ?>'> <?php echo $post_status; ?> </option>
<?php

if($post_status == 'published'){
    echo "<option value='draft'> Draft </option>";
}else{
    echo "<option value='published'> Published </option>";
}
?>
            <option value=''></option>
        </select>
    </div>



    <div class="form-group">    
        <img width="100"  src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" name="image">
    </div>


    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags;?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10" >
<?php echo $post_content; ?>
        </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_posts" value="Update">
    </div>
    
</form>






