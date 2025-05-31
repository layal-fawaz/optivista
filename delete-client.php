<?php
include('database.php');
if (isset($_GET['id'])) {
    $client_id = $_GET['id'];

        $sql = "DELETE FROM clients WHERE id = $client_id";
        $result = mysqli_query($connection, $sql);

        if ($result) {
            header("Location:show-clients-details.php");
            exit();
        } else {
            echo "failed to delete " . mysqli_error($connection);
        }
    } 
?>
