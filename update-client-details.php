

<?php
include('database.php');

// تهيئة مصفوفة فارغة لحفظ بيانات العميل
$client = [
    'name' => '',
    'age' => '',
    'phone_number' => '',
    'date' => '',
    'medical_history' => ''
];

// جلب بيانات العميل الحالي
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM clients WHERE id = '$id'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $client = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Client not found!'); window.location.href='show-clients-details.php';</script>";
        exit;
    }
}

// عند الضغط على زر التحديث
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $phoneNumber = $_POST['phone_number'];
    $date = $_POST['date'];
    $medical_history = $_POST['medical_history'];

    $update_query = "UPDATE clients SET 
        name = '$name', 
        age = '$age', 
        phone_number = '$phoneNumber', 
        date = '$date', 
        medical_history = '$medical_history' 
        WHERE id = '$id'";

    $update_result = mysqli_query($connection, $update_query);

    if ($update_result) {
        echo "<script>alert('Client updated successfully!'); window.location.href='show-clients-details.php';</script>";
        exit;
    } else {
        echo "<script>alert('Update failed');</script>";
    }
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
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-body">
<?php include('header.php'); ?>

<div class="container">
    <h2>Update Client Details</h2>
    <form method="POST" action="">
        <div>
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($client['name']) ?>" required>
        </div>

        <div>
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?= htmlspecialchars($client['age']) ?>" required>
        </div>

        <div>
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" value="<?= htmlspecialchars($client['phone_number']) ?>" required>
        </div>

        <div>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?= htmlspecialchars($client['date']) ?>" required>
        </div>

        <div>
            <label for="medical_history">Medical History:</label>
            <textarea id="medical_history" name="medical_history" required><?= htmlspecialchars($client['medical_history']) ?></textarea>
        </div>

    <div class="flex">
<button class="button">
<a href="update-glass-details.php?id=<?= $id ?>">update glass details

</button>  
  <button type="submit" name="update" id="update">Update</button>
    </div>
        </form>
    </div>
    <script src="js/bootstrap.bundle.js"></script>
</body>
</html>
