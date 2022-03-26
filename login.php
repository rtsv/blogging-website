<?php
session_start();
?>
<html>
    <div align = 'center'>
    <head>
        <h2>Log-In</h2>
    </head>
    <body>
        <form method="POST" action="">
            <label>Email</label>
            <input type="text" name="email" required><br>
            <label>Password</label>
            <input type="password" name="password" required><br>
            <button type="submit" name="submit">LogIn</button>
        </form>
        <p>Create User to Login
        <a href="register.php">Register!</a>
        </p>
    </body>
    </div>
</html>


<?php

// For Displaying Error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db-config.php';

if(isset($_POST["submit"])) {


    $email = $_POST['email'];
    $password = $_POST['password'];
    $encrypt_pwd = md5($password);

    $sql = "SELECT `id` FROM `user` WHERE `Email` = '$email' AND `Password` = '$encrypt_pwd'";

    $result = $con->query($sql);
    // print_r($result);
    $data = mysqli_fetch_assoc($result);
    print_r($data);
    if(!empty($data))
    {
        $_SESSION['userid'] = $data["id"];
        header("location: index.php");
    }
    else echo "Login credentials are incorrect";

    // exit();
}



// function test_input($data){
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
// }

// if ($_SERVER["REQUEST_METHOD"]== "POST"){
//     $username = test_input($_POST["username"]);
//     $password = test_input($_POST["password"]);
//     $stmt = $con->prepare("SELECT * FROM Login");
//     print_r($stmt)
//     print_r($stmt->execute());
//     // $users = $stmt->mysqli_fetch_assoc();

//     foreach($users as $user){
//         if(($user['username'] == $username) &&
//         ($user['password'] == $password)){
//             header("Location: login.php");
//         }
//         else {
//             echo "<script language='javascript'>";
//             echo "alert('Wrong Information')";
//             echo "</script>";
//             die();
//         }
//     }
// }


?>