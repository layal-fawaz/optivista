<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hom</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php
session_start();
include('database.php');
include('header.php');
?>
<main>
<section id="hero">
    <div>
        <h4>Looking for an old customer ? <br>Search now</h4>
        <form method="post" action="search.php">
    <input type="search" name="search_input" placeholder="Search customer">
    <select class="form-select" name="search_category" aria-label="Select category">
        <option value="">Select search category</option>
        <option value="name">Customer Name</option>
        <option value="age">Age</option>
        <option value="date">Examination Date</option>
    </select>
    <button type="submit" name="search">Search</button>
</form>
    </div>
    <video src="assets/images/hos.mp4" autoplay loop muted></video>
</section>
</main>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/main.js"></script>
</body>
</html>
<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "optivista");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['search'])) {
    $search_input = trim($_POST['search_input']);
    $search_category = $_POST['search_category'];

    if (empty($search_category)) {
        if (!empty($search_input)) {
            $sql = "SELECT * FROM clients WHERE name LIKE '%$search_input%'";
            $result = mysqli_query($connection, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $_SESSION['client_data'] = mysqli_fetch_assoc($result);
                echo "<script>window.location.href='client-information.php';</script>";
                exit;
            } else {
                echo "<script>alert('⚠️ No customer found with this name')</script>";
            }
        } else {
            echo "<script>alert('⚠️ Please enter a name to search')</script>";
        }
    } 
    else {
        if ($search_category == 'name') {
            $sql = !empty($search_input) 
                ? "SELECT * FROM clients WHERE name LIKE '%$search_input%'" 
                : "SELECT * FROM clients";
        } elseif ($search_category == 'age') {
            $sql = !empty($search_input) 
                ? "SELECT * FROM clients WHERE age = '$search_input'" 
                : "SELECT * FROM clients";
        } elseif ($search_category == 'date') {
            $sql = !empty($search_input) 
                ? "SELECT * FROM clients WHERE date = '$search_input'" 
                : "SELECT * FROM clients";
        }

        $result = mysqli_query($connection, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $_SESSION['search_results'] = [];

            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['search_results'][] = $row;
            }

            echo "<script>window.location.href='search.php';</script>";
            exit;
        } else {
            echo "<script>alert('⚠️ No matching customers found')</script>";
        }
    }
}
?>
