<?php
session_start();
//E-mail change
if (isset($_POST['submitEmail'])) {
//    connect with database
    require_once "../../class/Database.php";
    $usersID = $_SESSION['usersID'];
    $email = Database::realString($_POST['email']);
    $newEmail = Database::realString($_POST['newEmail']);

    $result = Database::query("SELECT * FROM Users WHERE email = '$email' AND usersID = '$usersID'");
    $resultNewEmail = Database::query("SELECT * FROM Users WHERE email = '$newEmail'");
//    Checking if the user has entered a good old email
    if (Database::numRows($result) <= 0) {
        $error[] = "Wrong email";
//        Checking if a new email exists in the database
    } else if (Database::numRows($resultNewEmail) >= 1) {
        $error[] = "Someone is already using this email.";
    } else {
//        Checking if emails are different
        if ($_POST['email'] == $_POST['newEmail']) {
            $error[] = "Email must be different";
        } else {
            session_unset();
            session_destroy();
            header("Location: ../../../index.php");
            Database::query("UPDATE users SET email='$newEmail' WHERE usersID = '$usersID'");
            Database::disconnect();
        }
    }
}
//Password Change
if (isset($_POST['submitPassword'])) {
    //    connect with database
    require_once "../../class/Database.php";
    $usersID = $_SESSION['usersID'];
    $password = md5($_POST['password']);
    $newPassword = md5($_POST['newPassword']);
    $newPasswordRepeat = md5($_POST['newPasswordRepeat']);

    $result = Database::query("SELECT * FROM Users WHERE password = '$password' AND usersID = '$usersID'");
//    Checking if the user has entered a good old password
    if (Database::numRows($result) <= 0) {
        $error[] = "Wrong password";
    } else {
//        Checking if passwords are the same
        if ($password == $newPassword){
            $error[] = "Old password and new password must be different";
        }else {
            if ($_POST['newPassword'] != $_POST['newPasswordRepeat']) {
                $error[] = "Password must be the same ";
            } else {
                session_unset();
                session_destroy();
                header("Location: ../../../index.php");
                Database::query("UPDATE users SET password='$newPassword' WHERE usersID = '$usersID'");
                Database::disconnect();
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
    <?php
    require_once "../html_file/links.html";
    ?>
</head>
<body>
<?php
require_once "../html_file/navbar_users.html";
?>
<div class="container-fluid" style="margin-top: 80px">
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