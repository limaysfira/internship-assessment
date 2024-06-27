<?php 
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Initialize variables for form inputs
$username = $_SESSION['username'];
$email = "";
$about = "";

// Establish connection to your database
$con = mysqli_connect("localhost:3307", "root", "", "assessment");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user details from database based on username
$query = "SELECT email, about FROM user WHERE username = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    $about = $row['about'];
} else {
    // Handle case where user details are not found
    $email = "Email not found";
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['save_draft'])) {
        // Save draft logic
        $about = $_POST['about']; // Get updated about text from form
        
        // Update about field in session for immediate display
        $_SESSION['about'] = $about;

        // Display success message (you can implement actual saving logic with AJAX if needed)
        echo "<script>alert('Draft saved successfully');</script>";
    } elseif (isset($_POST['submit_update'])) {
        // Update database with submitted information
        $about = $_POST['about']; // Get updated about text from form

        // Update database query
        $query_update = "UPDATE user SET about = ? WHERE username = ?";
        $stmt_update = mysqli_prepare($con, $query_update);
        mysqli_stmt_bind_param($stmt_update, "ss", $about, $username);
        
        if (mysqli_stmt_execute($stmt_update)) {
            // Update session with new about text
            $_SESSION['about'] = $about;
            echo "<script>alert('Profile updated successfully');</script>";
        } else {
            echo "Error updating profile: " . mysqli_error($con);
        }
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>User Profile</h2>
        <form id="profile-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" disabled>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" disabled>
            
            <label for="about">About Me:</label>
            <textarea id="about" name="about"><?php echo htmlspecialchars($about); ?></textarea>
            
            <button type="submit" name="save_draft">Save Draft</button>
            <button type="submit" name="submit_update">Submit</button>
        </form>
        <form action="logout.php" method="post">
            <button type="submit">Logout</button>
        </form>
    </div>

    <script>
        // Optional: You can add JavaScript for more interactive user experience here
    </script>
</body>
</html>
