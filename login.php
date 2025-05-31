<?php
session_start();
include('database.php');

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    extract($_POST);
    
    if (isset($login)) {
        $connection = mysqli_connect("localhost", "root","", "optivista");

        if (!$connection) {
            echo "<script>alert('Connection failed: " . mysqli_connect_error() . "');</script>";
            exit();
        }        $username = mysqli_real_escape_string($connection, $username);

        $query = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("خطأ في الاستعلام: " . mysqli_error($connection));
        }

        $row = mysqli_fetch_assoc($result);
        
        if ($row) {
            if (password_verify($password, $row['password'])) {
                // $_SESSION['username'] = $username;
                echo "<script>alert('تم العثور على المستخدم!');</script>";
                if ($row['role'] == 'admin') {
                    header("Location: dashboard.php");
                    exit();
                }
                
                if ($row['role'] == 'opto') {
                    header("Location: dashboard.php");
                    exit();
                }
                // header("Location: dashboard.php");
                // exit();
            } else {
                echo "<script>alert('كلمة المرور غير صحيحة!');</script>";
            }
        } else {
            echo "<script>alert('اسم المستخدم غير موجود!');</script>";
        }

        mysqli_close($connection);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<main class="main_login">
    <div class="form-container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <div>
                <label for="username">User Name:</label>
                <input type="text" name="username" required>
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>

            <input type="submit" name="login" value="Login">
        </form>
        <p>Don't have an account? <a href="">Sign Up</a></p>
    </div>

 <div class="circle left"></div>
 <div class="circle right"></div>
 <div class="circle right"></div>
</main>
</body>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/main.js"></script>
</html>