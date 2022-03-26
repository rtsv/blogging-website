<html>
    <!-- <img src="./image/<?php echo $row['Filename']; ?>" width="200" height="220" /> -->
    <h3>Change Profile Photo</h3>
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="file" name="file"></input>
        <button type="submit" name="upload">Upload</button>
    </form>

</html>
<?php
include 'db-config.php';
// Image Upload COde.
// $msg = "";
if(isset($_POST['upload'])){
    $filename = $_FILES["file"]["name"]; //File Name
    $tempname = $_FILES["file"]["tmp_name"];  // Temporary File Name
    $folder = "./image/".$filename;
    $sql1 = "INSERT INTO `profile_photo`(`filename`) VALUES ('$filename')";
    mysqli_query($con, $sql1);
    if(move_uploaded_file($tempname, '/xampp/htdocs/Ritesh/Registration/image/'.$filename)){ //Move File to its Destination        
        $msg = "Image Uploaded Successfully";
    }
    else{
        $msg = "Failed to upload";
    }
}
    
    $sql2="SELECT * FROM `profile_photo`";
    $query = $con->query($sql2);
    while($res = mysqli_fetch_array($query))
    {
        ?>
        <img src="./image/<?php echo $res['filename']; ?>" width="200" height="220" />
        <?php
    }
?>
