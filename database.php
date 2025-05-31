<?php
        $connection = mysqli_connect("localhost", "root","", "optivista");
        if (!$connection) {
            echo "<script>alert('Connection failed: " . mysqli_connect_error() . "');</script>";
            exit();
        }
?>
