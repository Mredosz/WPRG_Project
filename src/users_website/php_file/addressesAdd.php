<?php
session_start();
// Connect to SQL
global $resultAddresses;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    Website Title-->
    <title>Shrek's Restaurant</title>
    <!--    Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../src/style/form.css">
    <!--    Website icon-->
    <link rel="icon" href="../../../image/icon.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar bg-dark navbar-dark px-3 mb-3">
    <a class="navbar-brand" href="../../../src/users_website/php_file/users_index.php">Shrek's Restaurant</a>
    <h1 class="h">Addresses</h1>
    <ul class="nav nav-pills ms-auto flex-nowrap">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
           aria-expanded="false">
            <?php echo $_SESSION['userName'] ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark bg-dark">
            <li><a class="dropdown-item" href="orders.php">Orders</a></li>
            <li><a class="dropdown-item" href="addressesAdd.php">Addresses</a></li>
            <li><a class="dropdown-item" href="settings.php">Settings</a></li>
            <li>
                <hr class="dropdown-divider bg-secondary">
            </li>
            <li><a class="dropdown-item"
                   href="../../../src/users_website/php_file/logout.php">Log out</a></li>
        </ul>
    </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row row-cols-2">
        <div class="col-4 text-center">
            <h1 class="h1">Add Address</h1>
        </div>
        <div class="col-8 text-center">
            <h1 class="h1">Edit & Delete Address</h1>
        </div>
        <div class="col-4">
            <?php
            include "addresses.php";
            ?>

        </div>
        <div class="col-8">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">City</th>
                    <th scope="col">Zip Code</th>
                    <th scope="col">Street</th>
                    <th scope="col">Home Number</th>
                    <th scope="col">Phone Number</th>
                </tr>
                </thead>
            <?php
            while ($row = mysqli_fetch_array($resultAddresses)) {
                echo "<tbody>";
                echo "<tr>";
                echo("<td>$row[city]</td>");
                echo("<td>$row[zipCode]</td>");
                echo("<td>$row[street]</td>");
                echo("<td>$row[homeNumber]</td>");
                echo("<td>$row[phoneNumber]</td>");
                echo ("<td><a class='btn btn-outline-dark' href=\"addressesEdit.php?addressID=$row[addressID]\">Edit</a></td>");
                echo "</tr>";
                echo "</tbody>";
            }
            ?>
            </table>
        </div>
    </div>

</div>


</body>
</html>
