<?php session_start();

$username = $_POST['username'];
$password = $_POST['password']; // Keep the plain password

$con = mysqli_connect("localhost:3307", "root", "", "assessment");
$login = mysqli_query($con, "SELECT * FROM user WHERE username = '$username' AND password='$password'");
$result = mysqli_query($con, $login);

if ($result = mysqli_fetch_array($login)) 
{
    $_SESSION['username'] = $username;
    header("location: profile.php");
} 
else
{
    echo "Login Unsuccessful: User not found";
    include "login.php";
}

mysqli_close($con);
?>
