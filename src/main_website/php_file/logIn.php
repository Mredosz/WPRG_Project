<?php
// Connect to SQL
require_once "../../class/Database.php";
//When button sign up is clicked

if (isset($_POST['submit'])) {
//mysqli_real_escape_string() remove all special characters from string
//md5 codding string into 32 hexadecimal number

    $email = Database::realString($_POST['email']);
    $password = md5($_POST['password']);

    $result = Database::query("SELECT * FROM Users WHERE email = '$email' AND password = '$password'");
//When there is an account in the database with the given email and password
//the user is logged in
    if (Database::numRows($result) > 0) {
        $row = mysqli_fetch_array($result);
        session_start();
        $_SESSION['userName'] = $row['firstName'] . " " . $row['lastName'];
        $_SESSION['usersID'] = $row['usersID'];
        $_SESSION['rolaID'] = $row['rolaID'];
        header("Location: ../../../index.php");
    } else {
        $error[] = "Wrong password or email";
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
    <link rel="stylesheet" href="../../style/css/bootstrap.css">
</head>
<body>
<!--Short navbar to navigate to main website-->

<nav class="navbar bg-dark navbar-dark px-3 mb-3">
    <a class="navbar-brand" href="../../../index.php">Shrek's Restaurant</a>
    <h1 class="hlog">Log in</h1>
</nav>
<!--Form to log in-->

<form action="" method="post">
    <div class="container">
        <p>Please complete the information to log in.</p>
        <!--Container to displays errors-->

        <?php
        if (isset($error)) {
            foreach ($error as $item) {
                echo '<span class="error">' . $item . '</span>';
            }
        }
        ?>

        <label for="email"><b>E-mail</b></label>
        <!--               After misspelling the password, the email remains-->
        <input type="email" name="email" placeholder="Enter Your E-mail" required
               value="<?php if (isset($_POST['email'])) {
                   echo $_POST['email'];
               } ?>">

        <label for="password"><b>Password</b></label>
        <input type="password" name="password" placeholder="Enter Your Password" required>

        <div class="clearfix">
            <button type="reset" class="cancelbtn">Cancel</button>
            <button type="submit" class="signupbtn" name="submit">Sign Up</button>
            <p>You don't have account? <a href="signUp.php" id="a">Sing up</a></p>
        </div>
    </div>
</form>

</body>
</html>