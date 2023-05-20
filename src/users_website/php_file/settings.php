<?php
session_start();
//E-mail change
if (isset($_POST['submitEmail'])) {
//    connect with database
    include "../../main_website/php_file/config.php";
    global $conn;
    $usersID = $_SESSION['usersID'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $newEmail = mysqli_real_escape_string($conn, $_POST['newEmail']);

    $select = "SELECT * FROM Users WHERE email = '$email' AND usersID = '$usersID'";
    $result = mysqli_query($conn, $select);
    $selectNewEmail = "SELECT * FROM Users WHERE email = '$newEmail'";
    $resultNewEmail = mysqli_query($conn, $selectNewEmail);
//    Checking if the user has entered a good old email
    if (mysqli_num_rows($result) <= 0) {
        $error[] = "Wrong email";
//        Checking if a new email exists in the database
    } else if (mysqli_num_rows($resultNewEmail) != 1) {
        $error[] = "Someone is already using this email.";
    } else {
//        Checking if emails are different
        if ($_POST['email'] == $_POST['newEmail']) {
            $error[] = "Email must be different";
        } else {
            $update = "UPDATE users SET email='$newEmail' WHERE usersID = '$usersID'";
            session_unset();
            session_destroy();
            header("Location: ../../../index.php");
            mysqli_query($conn, $update);
            mysqli_close($conn);
        }
    }
}
//Password Change
if (isset($_POST['submitPassword'])) {
    //    connect with database
    include "../../main_website/php_file/config.php";
    global $conn;
    $usersID = $_SESSION['usersID'];
    $password = md5($_POST['password']);
    $newPassword = md5($_POST['newPassword']);
    $newPasswordRepeat = md5($_POST['newPasswordRepeat']);

    $select = "SELECT * FROM Users WHERE password = '$password' AND usersID = '$usersID'";
    $result = mysqli_query($conn, $select);
//    Checking if the user has entered a good old password
    if (mysqli_num_rows($result) <= 0) {
        $error[] = "Wrong password";
    } else {
//        Checking if passwords are the same
        if ($password == $newPassword){
            $error[] = "Old password and new password must be different";
        }else {
            if ($_POST['newPassword'] != $_POST['newPasswordRepeat']) {
                $error[] = "Password must be the same ";
            } else {
                $update = "UPDATE users SET password='$newPassword' WHERE usersID = '$usersID'";
                session_unset();
                session_destroy();
                header("Location: ../../../index.php");
                mysqli_query($conn, $update);
                mysqli_close($conn);
            }
        }
    }
}
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
    <a class="navbar-brand" href="../../../../WPRG_Project/index.php">Shrek's Restaurant</a>
    <h1 class="h">Settings</h1>
    <ul class="nav nav-pills ms-auto flex-nowrap">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <!-- Show First name and Last name user-->
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
    <div class="row">
        <!--    Display errors-->
        <?php
        if (isset($error)) {
            foreach ($error as $item) {
                echo '<span class="error">' . $item . '</span>';
            }
        }
        ?>
        <div class="col">
            <h2 class="h2 text-center">Change E-mail</h2>
            <form method="post" action="">
                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Enter your e-mail">

                <label for="newEmail">New E-mail</label>
                <input type="email" name="newEmail" placeholder="Enter new e-mail">

                <div class="clearfix">
                    <button type="reset" class="cancelbtn">Cancel</button>
                    <button type="submit" class="signupbtn" name="submitEmail">Submit</button>
                </div>
            </form>
        </div>
        <div class="col">
            <form method="post" action="">
                <h2 class="h2 text-center">Change Password</h2>
                <label for="password">Old Password</label>
                <input type="password" name="password" placeholder="Enter your old password">

                <label for="password">New Password</label>
                <input type="password" name="newPassword" placeholder="Enter new password">

                <label for="password">Repeat New Password</label>
                <input type="password" name="newPasswordRepeat" placeholder="Repeat new password">

                <div class="clearfix">
                    <button type="reset" class="cancelbtn">Cancel</button>
                    <button type="submit" class="signupbtn" name="submitPassword">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>