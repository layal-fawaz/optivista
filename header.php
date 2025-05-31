<header>
    <nav class="navbar bg-body-tertiary fixed-top ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <h1>optivista</h1>
            </a> <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">optivista</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add-customer-data.php">add new client</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="show-clients-details.php">show all clients</a></li>
                                <li><a class="dropdown-item" href="information.html">search about information</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#blog">update clients details</a></li>
                                <li><a class="dropdown-item" href="#design">fetures</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="login.php">login</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="register.php">register</a>
                        </li>
                    </ul>
                    <form method="post" action="" class="d-flex mt-3" >
        <input type="search" name="search_input" placeholder="search customer" class="form-control me-2">
            <button type="submit" name="search">Search</button>
                </div>
            </div>
        </div>
    </nav>
</header>
<?php
// include('database.php');
// if (isset($_POST['search'])) {
//     $search_name = trim($_POST['search_input']); 

//     if (!empty($search_name)) {
//         $aql = "SELECT * FROM clients WHERE name LIKE '%$search_name%'";
//         $result = mysqli_query($connection, $aql);

//         if ($result && mysqli_num_rows($result) > 0) {
//             $client_data = mysqli_fetch_assoc($result);
//             $_SESSION['client_data'] = $client_data;
//             echo "<script>window.location.href='client-information.php';</script>";
//             exit;
//         } else {
//             echo "<script>alert('⚠️no customer in this name')</script>";
//         }
//     } else {
//         echo "<script>alert('⚠️please enter valid value')</script>";
//     }
// }
?>