<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "optivista");

if (!$connection) {
    echo "<script>alert('Something went wrong. Please try again.');</script>";
    exit();
}

$client_id = $_SESSION['client_id'];
$client_age = $_SESSION['client_age'];
$old_glasses=$_SESSION['old_glasses'];

if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST['save_glass'])) {
    $spher_r = $_POST['r_sphere'];
    $cyl_r = $_POST['r_cyl'];
    $axis_r = $_POST['r_axis'];
    $add_r = $_POST['r_add'] ?? null;
    $pd_r = $_POST['r_pd'];
    $va_cc_r = $_POST['r_va_cc'];
    $va_sc_r = $_POST['r_va_sc'];

    $spher_l = $_POST['l_sphere'];
    $cyl_l = $_POST['l_cyl'];
    $axis_l = $_POST['l_axis'];
    $add_l = $_POST['l_add'] ?? null;
    $pd_l = $_POST['l_pd'];
    $va_cc_l = $_POST['l_va_cc'];
    $va_sc_l = $_POST['l_va_sc'];

    $sql = "UPDATE clients 
            SET 
                r_sphere='$spher_r', r_cyl='$cyl_r', r_axis='$axis_r', r_add='$add_r',
                r_pd='$pd_r', r_va_cc='$va_cc_r', r_va_sc='$va_sc_r',
                l_sphere='$spher_l', l_cyl='$cyl_l', l_axis='$axis_l', l_add='$add_l',
                l_pd='$pd_l', l_va_cc='$va_cc_l', l_va_sc='$va_sc_l'
            WHERE id = '$client_id'";

    if (mysqli_query($connection, $sql)) {
        echo "<script>alert('Glass info added successfully'); window.location.href='add-info.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($connection) . "');</script>";
    }

    mysqli_close($connection);
}

if($old_glasses=='yes'){
echo "<table>";
echo " <tr>";
echo "<th></th>";
echo "                <th>Sphere</th>
";
echo " <th>Cyl</th>";
if($client_age >= 40){ echo "<th>Add</th>"; }
echo "</thead>";
echo "</table>";

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eye Measurements</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/st.css">
</head>
<body style="background-color: #fff;">
<?php include('header.php'); ?>

<div class="details hidden">
    <h2>Eye Measurements</h2>
    <form method="POST" action="">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>Sphere</th>
                    <th>Cyl</th>
                    <th>Axis</th>
                    <th>PD</th>
                    <th>V.A CC</th>
                    <th>V.A SC</th>
                    <?php if($client_age >= 40){ echo "<th>Add</th>"; } ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Right Eye (R+)</th>
                    <td><input type="number" name="r_sphere" step="0.01" required></td>
                    <td><input type="number" name="r_cyl" step="0.01"></td>
                    <td><input type="number" name="r_axis" step="1"></td>
                    <td><input type="number" name="r_pd" step="0.1" required></td>
                    <td><input type="text" name="r_va_cc" placeholder="e.g. 20/20"></td>
                    <td><input type="text" name="r_va_sc" placeholder="e.g. 20/20"></td>
                    <?php if($client_age >= 40){ echo '<td><input type="number" name="r_add" step="0.01"></td>'; } ?>
                </tr>
                <tr>
                    <th>Left Eye (L+)</th>
                    <td><input type="number" name="l_sphere" step="0.01" required></td>
                    <td><input type="number" name="l_cyl" step="0.01"></td>
                    <td><input type="number" name="l_axis" step="1"></td>
                    <td><input type="number" name="l_pd" step="0.1" required></td>
                    <td><input type="text" name="l_va_cc" placeholder="e.g. 20/20"></td>
                    <td><input type="text" name="l_va_sc" placeholder="e.g. 20/20"></td>
                    <?php if($client_age >= 40){ echo '<td><input type="number" name="l_add" step="0.01"></td>'; } ?>
                </tr>
            </tbody>
        </table>
        
        <input type="submit" name="save_glass" value="Save Glass Info" class="btn btn-success">
        <a href="add.html" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>


<!-- 
<section id="mobile-view" >
<form method="POST" action="">
    <div class="glass-input-block">
        <h5>Right Eye (R+)</h5>
        <div class="input-group">
            <label for="r_sphere">Sphere</label>
            <input type="number" name="r_sphere" step="0.01" required>
        </div>
        <div class="input-group">
            <label for="r_cyl">Cyl</label>
            <input type="number" name="r_cyl" step="0.01">
        </div>
        <div class="input-group">
            <label for="r_axis">Axis</label>
            <input type="number" name="r_axis" step="1">
        </div>

        
        <div class="input-group">
            <label for="r_pd">PD</label>
      <input type="number" name="r_pd" step="0.1" required>
            </div>

        <div class="input-group">
            <label for="r_va_cc">VA CC</label>
            <input type="text" name="r_va_cc" placeholder="e.g. 20/20">
        </div>

        <div class="input-group">
            <label for="r_va_sc">VA SC<</label>
            <input type="text" name="r_va_sc" placeholder="e.g. 20/20">
        </div>


        <?php if($client_age >= 40): ?>
        <div class="input-group">
            <label for="r_add">Add</label>
            <input type="number" name="r_add" step="0.01">
        </div>
        <?php endif; ?>
        <div class="input-group">
            <label for="r_old">Old Glass</label>
            <input type="number" name="r_old" step="0.01">
        </div>
    </div>

    <div class="glass-input-block">
        <h5>Left Eye (L+)</h5>
        <div class="input-group">
            <label for="l_sphere">Sphere</label>
            <input type="number" name="l_sphere" step="0.01" required>
        </div>
        <div class="input-group">
            <label for="l_cyl">Cyl</label>
            <input type="number" name="l_cyl" step="0.01">
        </div>
        <div class="input-group">
            <label for="l_axis">Axis</label>
            <input type="number" name="l_axis" step="1">
        </div>

        <div class="input-group">
            <label for="l_pd">PD</label>
      <input type="number" name="l_pd" step="0.1" required>
            </div>

        <div class="input-group">
            <label for="l_va_cc">VA CC</label>
            <input type="text" name="l_va_cc" placeholder="e.g. 20/20">
        </div>

        <div class="input-group">
            <label for="r_va_cc">VA SC<</label>
            <input type="text" name="l_va_sc" placeholder="e.g. 20/20">
        </div>

        <?php if($client_age >= 40): ?>
        <div class="input-group">
            <label for="l_add">Add</label>
            <input type="number" name="l_add" step="0.01">
        </div>
        <?php endif; ?>
        <div class="input-group">
            <label for="l_old">Old Glass</label>
            <input type="number" name="l_old" step="0.01">
        </div>
    </div>

    <input type="submit" name="save_glass" value="Save Glass Info" class="btn btn-success">
    <a href="add.html">Back</a>
</form>

</section> -->
    <script src="js/bootstrap.bundle.js"></script>
</body>
</html>

