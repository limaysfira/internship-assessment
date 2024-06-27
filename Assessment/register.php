<?php
if(isset($_POST['register']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    
    $con = mysqli_connect("localhost:3307", "root", "", "assessment");
    
    if ($con) {
        $query = "INSERT INTO user (username, email, password, about) VALUES ('$username', '$email', '$password', '')";
        
        if (mysqli_query($con, $query)) {
            echo "<script>alert('Registration Successful'); window.location.href='login.php';</script>"; // Use JavaScript to redirect after alert
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Connection failed: " . mysqli_connect_error();
    }
    
    mysqli_close($con);
}
?>