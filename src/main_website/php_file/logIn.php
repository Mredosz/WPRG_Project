<?php
// Connect to SQL
include "config.php";
global $conn;

if (isset($_POST['submit'])) {

    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);

    $select = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
            session_start();
            $_SESSION['userName'] = $row['firstName']." ". $row['lastName'];
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
</head>
<body>
<form action="" method="post">
    <div class="container">
        <h1 class="h1">Log in</h1>
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
            <button type="submit" class="signupbtn" name="submit">Sign Up</button>
            <p>You don't have account? <a href="signUp.php">Sing up</a></p>
        </div>
    </div>
</form>

</body>
</html>