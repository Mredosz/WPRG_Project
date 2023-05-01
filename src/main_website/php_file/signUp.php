<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    Website Title-->
    <title>Shrek's Restaurant</title>
    <!--    Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../src/style/form.css">
    <!--    Website icon-->
    <link rel="icon" href="../../../../WPRG_Project/image/icon6.ico">
</head>
<body>
<form action="signUp.php">
    <div class="container">
        <h1 class="h1">Sign Up</h1>
        <p>Please complete the information to create an account.</p>

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
            <button type="submit" class="signupbtn">Sign Up</button>
        </div>
    </div>
</form>
</body>
</html>