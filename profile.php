<?php
session_start();
if(isset($_SESSION['userid']))
{
    echo "User :- ".$_SESSION['userid'];
    
    echo "<br>";
    include 'db-config.php';
    ?>
    <html>
        <head>
            <a href="index.php"><button>See Post</button></a><br>
        
            <!-- Bootstrap Table -->
            <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
        </head>
        <body>
    
            <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);


            $userid = $_SESSION['userid'];
            $sql = "SELECT * FROM `user` WHERE `id` = '$userid'";
            $result1 = $con->query($sql);

            while($row = mysqli_fetch_assoc($result1))
            {
                ?>
                <!-- <img src="./image/<?php #echo $row['Filename']; ?>" width="200" height="220" />
                <h3>Change Profile Photo</h3>
                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="file" name="file"></input>
                    <button type="submit" name="upload">Upload</button>
                </form> -->

                <?php
            
                // echo "Profile Photo : ".$row["Filename"];

                echo "Email : ".$row['email']."<br>";
                $image = $row['filename'];
                if($row['filename']!=NULL)
                {
                ?>
                    <img src="./profile-photo/<?php echo $row['filename']; ?>" width="200" height="220" />
                <?php
                }
                
        
                ?>
                <form method="post" action="" enctype="multipart/form-data">
                    <label>Name</label><br>
                    <input type="text" name="name2" value="<?php echo $row["name"] ?>"><br>
                    <label>Phone</label><br>
                    <input type="text" name="phone2" value="<?php echo $row["phone"] ?>"><br>
                    <label>Change Profile Photo</label><br>
                    <input type="file" name="file" value="<?php echo $row["filename"] ?>"></input><br>
                    
                    <button type="submit" name="submit">Update</button>
                </form>
                <?php
                echo "<br>";
            }
            if(isset($_POST['submit']))
            {
                $name = $_POST['name2'];
                $phone = $_POST['phone2'];
                $filename = $_FILES["file"]["name"]; //File Name
                $tempname = $_FILES["file"]["tmp_name"];  // Temporary File Name
                $folder = "./profile-photo/".$filename;
                $sql_update="UPDATE `user` SET `name`='$name',`phone`='$phone',`filename`='$filename' WHERE `id` = '$userid'";
                if($con->query($sql_update) && move_uploaded_file($tempname, '/xampp/htdocs/Ritesh/Registration/profile-photo/'.$filename))
                {
                    echo "Updated Successfully";
                }
            }

            ?>

            <p><b>Click on Below Button to Logout</p>
            <a href="logout.php">Logout</a>

        </body>
    </html>
    <?php
}
?>
