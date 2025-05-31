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
<?php include('header.php');

// if (isset($_POST['search'])) {
//     $category = $_POST['search-category'];
//     $input = mysqli_real_escape_string($connection, $_POST['search-input']);

//     if ($category === "name") {
//         $sql = "SELECT * FROM clients WHERE name LIKE '%$input%'";
//     } elseif ($category === "age") {
//         $sql = "SELECT * FROM clients WHERE age = '$input'";
//     } elseif ($category === "date") {
//         $sql = "SELECT * FROM clients WHERE date = '$input'";
//     } else {
//         $sql = "SELECT * FROM clients";
//     }
// } else {
//     $sql = "SELECT * FROM clients";
// }

?>

<main>
<section id="search">
    <div class="d-flex">
        <h3>All patients in the system</h3>
        <form class="d-flex" role="search" method="post" action="">
            <input class="form-control me-2" type="search" placeholder="Enter client name" aria-label="Search" name="search-input">
            <button class="btn btn-outline-success" type="submit" name="search">Search</button>
        </form>
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
        $connection = mysqli_connect("localhost", "root", "", "optivista");
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }  

        if (isset($_POST['search']) && !empty($_POST['search-input'])) {
            $searchName = mysqli_real_escape_string($connection, $_POST['search-input']);
            $sql = "SELECT * FROM clients WHERE name LIKE '%$searchName%'";
        } else {
            $sql = "SELECT * FROM clients";
        }

        $result = mysqli_query($connection, $sql);
        if (!$result) {
            die("Query failed: " . mysqli_error($connection));
        }

        if (mysqli_num_rows($result) > 0) {
            while ($client = mysqli_fetch_assoc($result)) {
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
                echo "<th></th>";
                echo "<th>Sphere</th>";
                echo "<th>Cyl</th>";
                echo "<th>Axis</th>";
                echo "<th>Add</th>";
                echo "<th>Old Glass</th>";
                echo "<th></th>";
                echo "</tr>";
                
                echo "<tr class='eye-details' id='details-" . $client['id'] . "-r' style='display: none; background-color: #f0f0f0'>";
                echo "<th>R+</th>";
                echo "<td>" . htmlspecialchars($client['r_sphere']) . "</td>";
                echo "<td>" . htmlspecialchars($client['r_cyl']) . "</td>";
                echo "<td>" . htmlspecialchars($client['r_axis']) . "</td>";
                echo "<td>" . htmlspecialchars($client['r_add']) . "</td>";
                echo "<td>   <a href='update-glass-details.php?id=" . $client['id'] . "' title='Update'>
                <i class='fa-solid fa-user-pen'></i>
            </a> </td>";
                            echo "</tr>";
                
                echo "<tr class='eye-details' id='details-" . $client['id'] . "-l' style='display: none; background-color: #f0f0f0'>";
                echo "<th>L+</th>";
                echo "<td>" . htmlspecialchars($client['l_sphere']) . "</td>";
                echo "<td>" . htmlspecialchars($client['l_cyl']) . "</td>";
                echo "<td>" . htmlspecialchars($client['l_axis']) . "</td>";
                echo "<td>" . htmlspecialchars($client['l_add']) . "</td>";
                
                echo "<td>   <a href='update-glass-details.php?id=" . $client['id'] . "' title='Update'>
                            <i class='fa-solid fa-user-pen'></i>
                        </a> </td>";
                echo "</tr>";
                
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

</script>

</body>
</html>
