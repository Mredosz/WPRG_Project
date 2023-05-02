<?php
// Connect to SQL
include "config.php";
global $conn;

if (isset($_POST['submit'])){

    $firstName = mysqli_escape_string($conn,$_POST['firstName']);
    $lastName = mysqli_escape_string($conn,$_POST['lastName']);
    $email = mysqli_escape_string($conn,$_POST['email']);
    $password = md5($_POST['password']);
    $passwordRepeat = md5($_POST['passwordRepeat']);

    $select = "SELECT * FROM Users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result)>0){
        $error[] = "Account already exist!";
    }else{
        if ($password != $passwordRepeat){
            $error[] = "Passwords must be the same";
        }else{
            $insert = "INSERT INTO Users(firestName, lastName, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')";
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
</head>
<body>
<form action="" method="post">
    <div class="container">
        <h1 class="h1">Sign Up</h1>
        <p>Please complete the information to create an account.</p>
        <?php
        if (isset($error)){
            foreach ($error as $item){
                echo '<span class="error">'.$item.'</span>';
            }
        }
        ?>
        <label for="firstName"><b>First Name</b></label>
        <input type="text" name="firstName" placeholder="Enter Your First Name" required>

        <label for="lastName"><b>Last Name</b></label>
        <input type="text" name="lastName" placeholder="Enter Your Last Name" required>

        <label for="email"><b>E-mail</b></label>
        <input type="email" name="email" placeholder="Enter Your E-mail" required>

        <label for="password"><b>Password</b></label>
        <input type="password" name="password" placeholder="Enter Your Password" required>

        <label for="passwordRepeat"><b>Repeat Password</b></label>
        <input type="password" name="passwordRepeat" placeholder="Repeat Password" required>

        <div class="clearfix">
            <a href="../../../index.php"><button type="button" class="cancelbtn">Cancel</button></a>
            <button type="submit" class="signupbtn" name="submit">Sign Up</button>
            <p class="p">You already have account? <a href="logIn.php">Log in</a></p>
        </div>
    </div>
</form>
</body>
</html>