<?php
session_start();
if(isset($_SESSION['userid'])){
$userid = $_SESSION['userid'];
include 'db-config.php';
?>
<br>
<!-- <a href="dashboard.php"><button>Profile</button></a><br> -->
<a href="index.php"><button>See Post</button></a><br>
<h3>POST</h3>
<body>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Title</label><br>
        <input type="text" name="title"><br>
        <label>Category</label><br>
        <select name="category" id="cars">
            <?php 
                $sql2="SELECT * FROM `posts_category`";
                $query2 = $con->query($sql2);
                while($res2=mysqli_fetch_assoc($query2))
                {
                    echo $res2["category_name"];
                    ?>
                    <option value="<?php echo $res2["category_name"] ?>"><?php echo $res2["category_name"] ?></option>
                    <?php 
                } 
                ?>
        </select><br>
        <label>Description<label><br>
        <textarea type="text" name="description"></textarea><br>
        <label>Add File<label><br>
        <input type="file" name="file"><br>
        <button type="submit" name="submit">Post</button>
    </form>
    <br>
    <p>
        <b>Click on Below Button to Logout
    </p>
        <a href="logout.php">Logout</a>
</body>

    <!-- VALIDATION OF REGISTER FORM -->
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        
        $(function(){
            $("form").validate({
                debug: false,
            rules: {
                title: {
                    required: true,
                    minlength: 3
                }
            },
            });
        });

    </script>
    <!-- VALIDATION FORM END -->
<?php

if(isset($_POST['submit']))
{
    $post_title = $_POST['title'];
    $post_cat = $_POST['category'];
    $post_desc = $_POST['description'];
    $post_image = $_FILES["file"]["name"]; //File Name
    $tempname = $_FILES["file"]["tmp_name"];  // Temporary File Name
    $folder = "./post-image/".$post_image;

    $add_post_sql = "INSERT INTO `posts`(`user_id`, `post_title`, `post_category`,`post_image`, `post_description`) VALUES ('$userid','$post_title','$post_cat','$post_image', '$post_desc')";
    if($con->query($add_post_sql) && move_uploaded_file($tempname, '/xampp/htdocs/Ritesh/Registration/post-image/'.$post_image)){
        echo "Successfully posted";
    }
    else
    {
        echo "Error In posting";
    }

}



// Image Upload COde
// $msg = "";
// if(isset($_POST['upload'])){
//     $filename = $_FILES["file"]["name"]; //File Name
//     $tempname = $_FILES["file"]["tmp_name"];  // Temporary File Name
//     $folder = "./image/".$filename;
//     $sql1 = "UPDATE `login` SET Filename = '$filename' WHERE Id= $Id";
//     mysqli_query($con, $sql1);
//     if(move_uploaded_file($tempname, '/var/www/html/Ritesh/image/'.$filename)){ //Move File to its Destination        
//         $msg = "Image Uploaded Successfully";
//     }
//     else{
//         $msg = "Failed to upload";
//     }
// }
}
else{
    
    header("location: logout.php");
}

?>