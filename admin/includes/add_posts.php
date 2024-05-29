<?php

    if(isset($_POST['create_post'])){
        
        $post_title = mysqli_real_escape_string($connection, $_POST['title']);
        $post_author = $_POST['post_author'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['image']['name'];
        $post_image_tmp = $_FILES['image']['tmp_name']; // The temporary file is not stored to the database yet until the user submit the submit button.

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');

        
      

        move_uploaded_file($post_image_tmp, "../images/$post_image"); //This will move the temporary image to our folder



        //We need a querry to insert the data from the user to the database.
        $query="INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES ({$post_category_id}, '{$post_title}','{$post_author}', now(),'{$post_image}' ,'{$post_content}','{$post_tags}', '{$post_status}')";

     
        $create_post_query = mysqli_query($connection,$query);

        // Called the Function
        confirmQuery($create_post_query);

        $the_post_id = mysqli_insert_id($connection);

        echo "<div class='alert alert-success'>Post Created Successfully!. <a href='../post.php?p_id=$the_post_id' class='btn btn-primary'>View Post</a></div>";
        
    }

?>





<!-- The enctype in a form allow us to sending differnt form of data because we need a image to be uploaded -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
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

        echo "<option value='$cat_id'> {$cat_title} </option>";
    }

?>
        </select>
    </div>




    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <select  name="post_status">
            <option value="draft"> Select Options</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input width="100" type="file" class="form-file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="summernote">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10" >
        </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
    
</form>