<!-- Header -->
<?php include "includes/admin_header.php" ?>
    <div id="wrapper">

<!-- Navigation -->
<?php include "includes/admin_navigation.php" ?>



        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        

                    <h1 class="page-header">
                            All Comments
                    </h1>

<?php

    if(isset($_GET['source'])){
        $source = $_GET['source'];
    }
    else{
        $source = '';
    }

    switch($source){
        case 'add_posts';
            include "includes/add_posts.php";
            break;

        case 'edit_posts';
            include "includes/edit_posts.php";
            break;

        case '200';
            echo "Nice 200";
            break;

        default:

        //Include the view all post.php to  display the table.
        include "includes/view_all_comments.php";

        break;
    }

?>
                    


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


<!-- Footer -->
<?php include "includes/admin_footer.php" ?>
