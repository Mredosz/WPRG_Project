<?php
// Connect to SQL
include "config.php";
global $conn;

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);

    $select = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
            session_start();
            $_SESSION['userName'] = $row['firstName']." ". $row['lastName'];
            $_SESSION['usersID'] = $row['usersID'];
            header("Location: ../../users_website/php_file/users_index.php");
    } else{
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
<nav  class="navbar bg-dark navbar-dark px-3 mb-3">
    <a class="navbar-brand" href="../../../index.php">Shrek's Restaurant</a>
    <h1 class="h">Log in</h1>
</nav>
<form action="" method="post">
    <div class="container">
        <p>Please complete the information to log in.</p>

        <?php
        if (isset($error)) {
            foreach ($error as $item) {
                echo '<span class="error">' . $item . '</span>';
            }
        }
        ?>

        <label for="email"><b>E-mail</b></label>
        <input type="email" name="email" placeholder="Enter Your E-mail" required
               value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>">

        <label for="password"><b>Password</b></label>
        <input type="password" name="password" placeholder="Enter Your Password" required>

        <div class="clearfix">
            <a href="../../../index.php">
                <button type="button" class="cancelbtn">Cancel</button>
            </a>
            <a><button type="submit" class="signupbtn" name="submit">Sign Up</button></a>
            <p>You don't have account? <a href="signUp.php" id="a">Sing up</a></p>
        </div>
    </div>
</form>

</body>
</html>