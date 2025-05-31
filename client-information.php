<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Details</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/media.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-body">
<?php
session_start();
include('database.php');
include('header.php');

if (isset($_SESSION['client_data'])) {
    $client = $_SESSION['client_data'];
?>

<div>
    <div class="container">
        <!-- Customer Info -->
        <div class="col-md-6 ">
            <div class="card shadow p-3">
                <h4 class="mb-3">🧾 Customer Information</h4>
                <ul class="list-unstyled">
                    <li><strong>Name:</strong> <?= $client['name']; ?></li>
                    <li><strong>Age:</strong> <?= $client['age']; ?></li>
                    <li><strong>Phone:</strong> <?= $client['phone_number']; ?></li>
                    <li><strong>Date:</strong> <?= $client['date']; ?></li>
                </ul>
            </div>
            <div style="min-height: 120px;">
<br>
  <button class="btn btn-outline-primary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
    Show Medical History
  </button>

  <div class="collapse collapse-horizontal" id="collapseWidthExample">
    <div class="card card-body" style="width: 300px;">
      <strong>Medical History:</strong><br>
      <?= htmlspecialchars($client['medical_history']); ?>
    </div>
  </div>
</div>

        </div>

        <!-- Eye Measurement -->
        <div class="col-md-6 mb-4">
                <h4 class="mb-3">👁️ Eye Measurements</h4>
                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                           <th>Sphere</th>
                    <th>Cyl</th>
                    <th>Axis</th>
                    <th>PD</th>
                    <th>V.A CC</th>
                    <th>V.A SC</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
    <th>R+</th>
    <td><?= htmlspecialchars($client['r_sphere']) ?></td>
    <td><?= htmlspecialchars($client['r_cyl']) ?></td>
    <td><?= htmlspecialchars($client['r_axis']) ?></td>
    <td><?= htmlspecialchars($client['r_pd']) ?></td> 
    <td><?= htmlspecialchars($client['r_va_cc']) ?></td> 
    <td><?= htmlspecialchars($client['r_va_sc']) ?></td> 
</tr>
<tr>
    <th>L+</th>
    <td><?= htmlspecialchars($client['l_sphere']) ?></td>
    <td><?= htmlspecialchars($client['l_cyl']) ?></td>
    <td><?= htmlspecialchars($client['l_axis']) ?></td>
    <td><?= htmlspecialchars($client['l_pd']) ?></td>
    <td><?= htmlspecialchars($client['l_va_cc']) ?></td> 
    <td><?= htmlspecialchars($client['l_va_sc']) ?></td>
</tr>

                    </tbody>
                </table>
            </div>
    </div>

    <!-- Purchases section (تحطيها لاحقًا لو بدك) -->
    <!-- <div class="row">
        <div class="col-12">
            <div class="card shadow p-3">
                <h4 class="mb-3">🛍️ Purchase History</h4>
                ... كود المشتريات هنا
            </div>
        </div>
    </div> -->
</div>

<?php
} else {
    echo "<script>alert('No data found.')</script>";
    exit;
}
?>

<script src="js/bootstrap.bundle.js"></script>
</body>
</html>
