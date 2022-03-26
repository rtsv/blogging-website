<html>
    <div>
    <head>
        <h2>RegisteR</h2>
    </head>
    <body>
        <form method="POST" action="" enctype="multipart/form-data">
            <label>Name</label>
            <input type="text" name="name" required><br>
            <label>Email</label>
            <input type="text" name="email" required><br>
            <label>Phone<label>
            <input type="text" name="phone" required><br>
            <label>Password</label>
            <input type="password" name="password" required><br>
            <label>Profile Photo</label>
            <input type="file" name="file"></input><br>
            <button type="submit" name="submit">Register</button>
        </form>
        <p>User is already created
        <a href="login.php">Login!</a>
        </p>
    </body>
    </div>
</html>
<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
include 'db-config.php';


if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $encrypt_pwd = md5($password);
    $filename = $_FILES["file"]["name"]; //File Name
    $tempname = $_FILES["file"]["tmp_name"];  // Temporary File Name
    $folder = "./profile-photo/".$filename;
    // print_r($encrypt_pwd);
    
    $found = 0;
    $sql2 = "SELECT * FROM `user`";
    $query = $con->query($sql2);
    while($res2=mysqli_fetch_array($query))
    {
        $email_verify = $res2['email'];
        if($email_verify==$email)
        { $found++; break;}
    }
    if($found==0)
    {
        $sql = "INSERT INTO `user`(`name`, `email`, `phone`, `filename`, `password`) VALUES ('$name','$email','$phone','$filename','$encrypt_pwd')";
        if($con->query($sql) && move_uploaded_file($tempname, '/xampp/htdocs/Ritesh/Registration/profile-photo/'.$filename))
        {
            echo "Successfully Registered"; 
        }
    }
    else{echo "Already registered";}
}
?>
