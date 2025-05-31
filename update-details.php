<?php
if (!isset($_GET['id'])) {
    echo "<script>alert('لم يتم تحديد العميل'); window.location.href='show-clients-details.php';</script>";
    exit;
}
$id = $_GET['id'];
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
  <?php include('header.php');?>
    <main>
        <section id="cards">
            <h3>welcome<span></span> hope you have a good day !</h3>
            <div class="cards">
                <div>
                <a href="update-client-details.php?id=<?= $id ?>">
                        <img src="assets/images/k.jpeg" alt="">
                        <h4>update client details</h4>
                    </a>
                </div>

                <div>
                <a href="update-glass-details.php?id=<?= $id ?>">
                <img src="assets/images/k.jpeg" alt="">
                        <h4>update glass details</h4>
                    </a>

                </div>

            </div>
        </section>
    </main>

    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>