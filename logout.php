<?php
session_start();
session_destroy();
echo "You are logged out";
echo "<br>";
echo "Please Click on below button to login again.";
echo "<br>";

?>
<html>
    <a href="login.php"><button>Login</button></a>
</html>