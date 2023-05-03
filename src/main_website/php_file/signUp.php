<?php
// Connect to SQL
include "config.php";
global $conn;

if (isset($_POST['submit'])) {

    $firstName = mysqli_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_escape_string($conn, $_POST['lastName']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $passwordRepeat = md5($_POST['passwordRepeat']);

    $select = "SELECT * FROM Users WHERE email = '$email' OR(email ='$email' AND password = '$password')";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = "Account already exist!";
    } else {
        if ($_POST['password'] != $_POST['passwordRepeat']) {
            $error[] = "Passwords must be the same";
        } else {
            $insert = "INSERT INTO Users(firstName, lastName, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')";
            mysqli_query($conn, $insert);
            header("Location: login.php");
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
</head>
<body>
<nav  class="navbar bg-dark navbar-dark px-3 mb-3">
    <a class="navbar-brand" href="../../../index.php">Shrek's Restaurant</a>
    <h1 class="h">Sign up</h1>
</nav>
<form action="" method="post">
    <div class="container">
        <p>Please complete the information to create an account.</p>
        <?php
        if (isset($error)) {
            foreach ($error as $item) {
                echo '<span class="error">' . $item . '</span>';
            }
        }
        ?>
        <label for="firstName"><b>First Name</b></label>
        <input type="text" name="firstName" placeholder="Enter Your First Name" required
               value="<?php if(isset($_POST['firstName'])) { echo $_POST['firstName']; } ?>">

        <label for="lastName"><b>Last Name</b></label>
        <input type="text" name="lastName" placeholder="Enter Your Last Name" required
               value="<?php if(isset($_POST['lastName'])) { echo $_POST['lastName']; } ?>" >

        <label for="email"><b>E-mail</b></label>
        <input type="email" name="email" placeholder="Enter Your E-mail" required
               value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>">

        <label for="password"><b>Password</b></label>
        <input type="password" name="password" placeholder="Enter Your Password" required>

        <label for="passwordRepeat"><b>Repeat Password</b></label>
        <input type="password" name="passwordRepeat" placeholder="Repeat Password" required>

        <div class="clearfix">
            <a href="../../../index.php">
                <button type="button" class="cancelbtn">Cancel</button>
            </a>
            <a><button type="submit" class="signupbtn" name="submit">Sign Up</button></a>
            <p class="p">You already have account? <a href="logIn.php" id="a">Log in</a></p>
        </div>
    </div>
</form>
</body>
</html>