<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    Website Title-->
    <title>Shrek's Restaurant</title>
    <!--    Custom CSS-->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!--    Website icon-->
    <link rel="icon" href="/image/icon.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!--    Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
<!--Navbar-->
<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
    <a class="navbar-brand" href="#">Shrek's Restaurant</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collaosibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collaosibleNavbar"></div>
    <!--    #about - go to another section in this file-->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-item" href="#about">About</a>
        </li>
        <li class="nav-item">
            <a class="nav-item" href="#menu">Menu</a>
        </li>
        <li class="nav-item">
            <a class="nav-item" href="#service">Service</a>
        </li>
        <li class="nav-item">
            <a class="nav-item" href="#contact">Contact</a>
        </li>
        <li class="nav-item">
            <a class="nav-item" href="singUp.php">Sing up</a>
        </li>
        <li class="nav-item">
            <a class="nav-item" href="logIn.php">Log in</a>
        </li>
    </ul>
</nav>
<!--    Header-->
<div class="jumbo">
    <div class="container-fluid">
        <div class="header-content-inner">
            <h1>Welcome to Shrek's Restaurant</h1>
            <h3>Text about restaurant</h3>
        </div>
    </div>
</div>

<section class="bg-about bg-section" id="about">
    <!--    class to create a full width container-->
    <div class="container-fluid">
        <h1 class="container-h1">About</h1>
        <div class="row">
            <div class="hov-img">
                <img src="/image/about1.jpg" alt="Welcome" class="hov-img-bottom img-fluid">
                <div class="hov-img-top hov-img-slideup">
                    <div class="hov-img-text">
                        <h5>Welcome</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sollicitudin nulla metus, sit
                            amet facilisis ligula interdum vel. Proin dictum malesuada venenatis. Nullam a vulputate
                            felis, quis consectetur nisl. Maecenas ut est quis justo cursus ultricies sit amet eleifend
                            lectus. Vestibulum eu tincidunt metus. Sed non nibh suscipit, blandit erat vitae, blandit
                            nibh. Sed semper lacus orci, ut elementum felis sagittis ac. Vivamus hendrerit sapien
                            turpis, et condimentum dui suscipit eget. Praesent viverra justo sed lorem sodales lacinia.
                            Quisque dictum venenatis nunc, sed laoreet leo. Pellentesque habitant morbi tristique
                            senectus et netus et malesuada fames ac turpis egestas. Cras fermentum dolor nec diam
                            commodo aliquet. Curabitur at augue vitae risus accumsan varius. Pellentesque leo enim,
                            tempor sed quam at, ullamcorper rutrum dui.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>

</body>
</html>