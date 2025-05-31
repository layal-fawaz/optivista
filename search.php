<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients List</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="login-body">
<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "optivista");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['search']) && !empty($_POST['search-input'])) {
    $searchName = mysqli_real_escape_string($connection, $_POST['search-input']);
    $sql = "SELECT * FROM clients WHERE name LIKE '%$searchName%'";
    $result = mysqli_query($connection, $sql);
    $_SESSION['search_results'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$clients = $_SESSION['search_results'] ?? [];

include('header.php');
?>

<main>
<section id="search">
    <div class="d-flex">
        <h3>All patients in the system</h3>
        <div class="row">
        <form class="d-flex" role="search" method="post" action="">
            <input class="form-control me-2" type="search" placeholder="Enter client name" aria-label="Search" name="search-input">
            <button class="btn btn-outline-success" type="submit" name="search">Search</button>
        </form></div>
    </div>

    <table>
        <tr>
            <th></th>
            <th>Full Name</th>
            <th>Age</th>
            <th>Phone Number</th>
            <th>Date</th>
            <th>Medical History</th>
            <th class="actions">Actions</th>
        </tr>

        <?php
        if (!empty($clients)) {
            foreach ($clients as $client) {
                echo "<tr>";
                echo "<td style='background-color: #977590 !important;'>
                        <a href='#' onclick='toggleEyeDetails(" . $client['id'] . ")'>
                            <i class='fa-solid fa-glasses'></i>
                        </a>
                      </td>";
                echo "<td>" . htmlspecialchars($client['name']) . "</td>";
                echo "<td>" . htmlspecialchars($client['age']) . "</td>";
                echo "<td>" . htmlspecialchars($client['phone_number']) . "</td>";
                echo "<td>" . htmlspecialchars($client['date']) . "</td>";
                echo "<td>" . htmlspecialchars($client['medical_history']) . "</td>";
                echo "<td class='actions'>
                        <a href='update-details.php?id=" . $client['id'] . "' title='Update'>
                            <i class='fa-solid fa-user-pen'></i>
                        </a>
                        <a href='delete-client.php?id=" . $client['id'] . "' onclick='return confirm(\"Are you sure you want to delete this client?\")'>
                            <i class='fa-solid fa-trash'></i>
                        </a>
                      </td>";
                echo "</tr>";

                echo "<tr class='eye-details' id='details-" . $client['id'] . "-header' style='display: none; background-color: #f0f0f0'>";
                echo "<th></th><th>Sphere</th><th>Cyl</th><th>Axis</th><th>Add</th><th>Old Glass</th><th></th></tr>";

                echo "<tr class='eye-details' id='details-" . $client['id'] . "-r' style='display: none; background-color: #f0f0f0'>";
                echo "<th>R+</th><td>" . htmlspecialchars($client['r_sphere']) . "</td><td>" . htmlspecialchars($client['r_cyl']) . "</td><td>" . htmlspecialchars($client['r_axis']) . "</td><td>" . htmlspecialchars($client['r_add']) . "</td><td><a href='update-glass-details.php?id=" . $client['id'] . "'><i class='fa-solid fa-user-pen'></i></a></td><td></td></tr>";

                echo "<tr class='eye-details' id='details-" . $client['id'] . "-l' style='display: none; background-color: #f0f0f0'>";
                echo "<th>L+</th><td>" . htmlspecialchars($client['l_sphere']) . "</td><td>" . htmlspecialchars($client['l_cyl']) . "</td><td>" . htmlspecialchars($client['l_axis']) . "</td><td>" . htmlspecialchars($client['l_add']) . "</td><td><a href='update-glass-details.php?id=" . $client['id'] . "'><i class='fa-solid fa-user-pen'></i></a></td><td></td></tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No clients found</td></tr>";
        }
        ?>
    </table>
</section>
</main>

<script src="js/bootstrap.bundle.js"></script>
<script src="main.js"></script>

<script>
function toggleEyeDetails(id) {
    let rows = [
        document.getElementById('details-' + id + '-header'),
        document.getElementById('details-' + id + '-r'),
        document.getElementById('details-' + id + '-l')
    ];
    
    rows.forEach(row => {
        if (row) {
            row.style.display = (row.style.display === 'none') ? 'table-row' : 'none';
        }
    });
}
</script>
</body>
</html>
