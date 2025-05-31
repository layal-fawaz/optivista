<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('header.php');?>
   <main>
    <div class="container">
        <h2>register</h2>
        <form action="" method="post">
            <div>
                <label for="username">User Name:</label>
                <input type="text" name="username" required>
            </div>

            <div>
                <label for="id">id:</label>
                <input type="id" name="id" required>
            </div>

            <div>
                <label for="phone_number">phone number:</label>
                <input type="phone_number" name="phone_number" required>
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>

            <label for="role">Role:</label>
            <select name="role" id="role">
            <option value="">select role</option>
                <option value="admin">admin</option>
                <option value="opto">opto</option>
            </select>
            <input type="submit" name="register" value="register">
        </form>
    </div>

 <div class="circle left"></div>
 <div class="circle right"></div>
 <div class="circle right"></div>
</main>
</body>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/main.js"></script>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    extract($_POST);
    if (isset($register)) {
        $connection = mysqli_connect("localhost", "root","", "optivista");

        if (!$connection) {
            echo "<script>alert('Connection failed: " . mysqli_connect_error() . "');</script>";
            exit();
        }

        mysqli_select_db($connection, "optivista");
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $insert = "INSERT INTO user (username,id, phone_number, password,role) 
                             VALUES ('$username', '$id', '$phone_number', '$hashed_password','$role')";

        if (!mysqli_query($connection, $insert)) {
            echo "<script> alert('Error in aggregate query: " . mysqli_error($connection) . "');</script>";
            mysqli_close($connection);
            exit();
        }}
        }?>