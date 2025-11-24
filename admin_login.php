<?php
// Start session BEFORE any HTML
session_start();

$error = "";

// Check if admin is already logged in
$isAdmin = $_SESSION['admin_login'] ?? false;

// Handle login form submit
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

    // Safely read POST values (prevents "Undefined array key" warnings)
    $uid = $_POST['uid'] ?? '';
    $password = $_POST['password'] ?? '';

    // Hardcoded admin credentials
    if ($uid === 'admin' && $password === 'admin') {
        $_SESSION['admin_login'] = true;
        $isAdmin = true;
    } else {
        $error = "Invalid User ID or Password.";
        $isAdmin = false;
    }
}
?>
<html>
<body style=" background-image: url('adminlogin.jpeg');
    height: 100%; 
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;">
<div align="center">

<?php 
// If logged in, show admin menu
if ($isAdmin) {
    echo " <br><a href=\"http://localhost/railway/insert_into_stations.php\"> Show All Stations </a><br> ";
    echo " <br><a href=\"http://localhost/railway/show_trains.php\"> Show All Trains </a><br> ";
    echo " <br><a href=\"http://localhost/railway/show_users.php\"> Show All Users </a><br> ";
    echo " <br><a href=\"http://localhost/railway/insert_into_train_3.php\"> Enter New Train </a><br> ";
    echo " <br><a href=\"http://localhost/railway/insert_into_classseats_3.php\"> Enter Train Schedule </a><br> ";
    echo " <br><a href=\"http://localhost/railway/booked.php\"> View all booked tickets </a><br> ";
    echo " <br><a href=\"http://localhost/railway/cancelled.php\"> View all cancelled tickets </a><br> ";
    // echo " <br><a href=\"http://localhost/railway/logout.php\"> Logout </a><br> ";
} else {

    // Show error if login failed
    if ($error !== "") {
        echo "<p style=\"color:red;\">$error</p>";
    }

    // Show login form
    echo '
    <form action="admin_login.php" method="post">
        User ID: <input type="text" name="uid" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    ';
}
?>

<br><a href="index.html">Go to Home Page!!!</a>

</div>
</body>
</html>
