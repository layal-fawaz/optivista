<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "optivista");

if (!$connection) {
    echo "<script>alert('Connection failed: " . mysqli_connect_error() . "');</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $age = $_POST['age'];
    $date = $_POST['date'];
    $medical_history = $_POST['medical_history'];

    $sql = "INSERT INTO clients (name, phone_number, age, date, medical_history)
            VALUES ('$name', '$phone_number', '$age', '$date', '$medical_history')";

    if (mysqli_query($connection, $sql)) {
        $_SESSION['client_id'] = mysqli_insert_id($connection);
        $_SESSION['client_age'] = $age;  

        header("Location:add-eye-measurement.php");
        exit();
    } else {
        echo "<script>alert('Error: " . mysqli_error($connection) . "');</script>";
    }

    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media.css">

</head>

<body class="login-body">
<?php include('header.php');?>
    <div class="container">
        <h2>Add new customer</h2>
        <form method="POST" action="">

<div>
    <label for="name">Full Name:</label>
    <input type="text" id="name" name="name" required>
</div>

<div>
    <label for="age">Age:</label>
    <input type="number" id="age" name="age" required>
</div>

<div>
    <label for="phone_number">Phone Number:</label>
    <input type="text" id="phone_number" name="phone_number" required>
</div>

<div>
    <label for="date">Examination Date:</label>
    <input type="date" id="date" name="date" required>
</div>

<div>
    <label for="old-glass">has an old glasses:</label>
   <div class="flex">
   <div class="flex">
   <input type="radio" id="old-glass" name="old-glass" value="yes" required>yes
   </div>
<div class="flex">
<input type="radio" id="old-glass" name="old-glass"  value="no" required>no

</div>   </div>
</div>
 
<div>
    <label for="medical_history">Medical History:</label>
    <textarea id="medical_history" name="medical_history"></textarea>
</div>

<button type="submit" name="add">Next</button>
</form>

    </div>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>
