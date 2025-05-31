
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
<?php include('database.php');
include('header.php');
if (!isset($_GET['id'])) {
    echo "<script>alert('لم يتم تحديد العميل'); window.location.href='show-clients-details.php';</script>";
    exit;
}


$id = $_GET['id'];
$query = "SELECT * FROM clients WHERE id = '$id'";
$result = mysqli_query($connection, $query);
$client = mysqli_fetch_assoc($result);


if (isset($_POST['save_glass'])) {
    $r_sphere = $_POST['r_sphere'];
    $r_cyl = $_POST['r_cyl'];
    $r_axis = $_POST['r_axis'];
    $r_add = $_POST['r_add'];
    $r_old = $_POST['r_old'];

    $l_sphere = $_POST['l_sphere'];
    $l_cyl = $_POST['l_cyl'];
    $l_axis = $_POST['l_axis'];
    $l_add = $_POST['l_add'];
    $l_old = $_POST['l_old'];

    $query = "UPDATE clients SET 
        r_sphere = '$r_sphere',
        r_cyl = '$r_cyl',
        r_axis = '$r_axis',
        r_add = '$r_add',
        r_old = '$r_old',
        l_sphere = '$l_sphere',
        l_cyl = '$l_cyl',
        l_axis = '$l_axis',
        l_add = '$l_add',
        l_old = '$l_old'
        WHERE id = '$id'";

    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "<script>alert('Glass info updated successfully!'); window.location.href='show-clients-details.php';</script>";
    } else {
        echo "<script>alert('Failed to update glass info');</script>";
    }
}
?>
<div class="details">
    <h2>Glass Information</h2>
    <form method="POST" action="">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>Sphere</th>
                    <th>Cyl</th>
                    <th>Axis</th>
                    <th>Add</th>
                    <th>Old Glass</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Right Eye (R+)</th>
                    <td><input type="number" name="r_sphere" step="0.01" required value="<?= $client['r_sphere'] ?? '' ?>"></td>
                    <td><input type="number" name="r_cyl" step="0.01" value="<?= $client['r_cyl'] ?? '' ?>"></td>
                    <td><input type="number" name="r_axis" step="1" value="<?= $client['r_axis'] ?? '' ?>"></td>
                    <td><input type="number" name="r_add" step="0.01" value="<?= $client['r_add'] ?? '' ?>"></td>
                    <td><input type="number" name="r_old" step="0.01" value="<?= $client['r_old'] ?? '' ?>"></td>
                </tr>
                <tr>
                    <th>Left Eye (L+)</th>
                    <td><input type="number" name="l_sphere" step="0.01" required value="<?= $client['l_sphere'] ?? '' ?>"></td>
                    <td><input type="number" name="l_cyl" step="0.01" value="<?= $client['l_cyl'] ?? '' ?>"></td>
                    <td><input type="number" name="l_axis" step="1" value="<?= $client['l_axis'] ?? '' ?>"></td>
                    <td><input type="number" name="l_add" step="0.01" value="<?= $client['l_add'] ?? '' ?>"></td>
                    <td><input type="number" name="l_old" step="0.01" value="<?= $client['l_old'] ?? '' ?>"></td>
                </tr>
            </tbody>
        </table>
        
        <a href="update-client-details.php?id=<?= $id ?>">update client details

        <input type="submit" name="save_glass" value="Save Glass Info" class="btn btn-success">
        <a href="add.html" class="btn btn-secondary">Back</a>
    </form>
</div>
