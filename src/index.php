<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    Website Title-->
    <title>Shrek's Restaurant</title>
    <!--    Custom CSS-->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!--    Custom JS-->
<!--    <script src="script.js"></script>-->
    <!--    Website icon-->
    <link rel="icon" href="/image/icon.ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!--    Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- Bootstrap JavaScript previous version-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

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
<!--Section with information about restaurant-->
<section class="bg-about bg-section" id="about">
    <!--    class to create a full width container-->
    <div class="container-fluid">
        <h1 class="container-h1">About</h1>
        <div class="row">
            <div class="col-sm-5">

                <div class="hov-img">
                    <img src="/image/about1.jpg" alt="Welcome" class="hov-img-bottom img-fluid">
                    <div class="hov-img-top hov-img-slideup">
                        <div class="hov-img-text">
                            <h5>Welcome</h5>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sollicitudin nulla metus,
                                sit
                                amet facilisis ligula interdum vel. Proin dictum malesuada venenatis. Nullam a vulputate
                                felis, quis consectetur nisl. Maecenas ut est quis justo cursus ultricies sit amet
                                eleifend
                                lectus. Vestibulum eu tincidunt metus. Sed non nibh suscipit, blandit erat vitae,
                                blandit
                                nibh. Sed semper lacus orci, ut elementum felis sagittis ac. Vivamus hendrerit sapien
                                turpis, et condimentum dui suscipit eget. Praesent viverra justo sed lorem sodales
                                lacinia.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="hov-img">
                    <img src="/image/about2.jpg" alt="Delicious meals" class="hov-img-bottom img-fluid">
                    <div class="hov-img-top hov-img-slideup">
                        <div class="hov-img-text">
                            <h5>Delicious meals</h5>
                            <p>Cras sit amet metus auctor, aliquet lectus sed, gravida enim. Aenean rutrum malesuada
                                mauris vel
                                convallis. Quisque ultricies fringilla ligula, vitae efficitur ex porttitor at. Nam
                                efficitur ante
                                vel erat auctor, non auctor purus ultricies. Quisque maximus nisl non mi laoreet
                                ultrices. Donec sit
                                amet mollis ligula. Quisque ut nulla scelerisque, ultrices metus id, condimentum nunc.
                                In vel justo
                                non leo ullamcorper vehicula vitae a turpis.</p>
                        </div>
                    </div>
                </div>

                <div class="hov-img">
                    <img src="/image/about3.jpg" alt="Professional staff" class="hov-img-bottom img-fluid">
                    <div class="hov-img-top hov-img-slideup">
                        <div class="hov-img-text">
                            <h5>Professional staff</h5>
                            <p>Ut eros nibh, blandit ut imperdiet non, gravida in augue. Sed sit amet est ac magna porta
                                dictum at ac lacus. Aliquam dictum gravida mauris nec efficitur. Nullam efficitur tellus
                                et erat maximus porta. Integer eget turpis elementum, rhoncus ligula id, ultrices
                                mauris. Fusce dignissim aliquam dolor, quis dictum enim gravida vitae. Praesent faucibus
                                libero erat, non ultrices enim scelerisque ac. Class aptent taciti sociosqu ad litora
                                torquent per conubia nostra, per inceptos himenaeos. Duis in finibus odio, ut maximus
                                lectus. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="row">
                    <div class="restaurant-history  text-center">
                        <h3 class="section-heading">Shrek's Restaurant</h3>
                        <p class="about-history first">Etiam maximus nibh ac turpis tempor dignissim. Aliquam erat
                            volutpat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus
                            mus. Nullam lobortis metus est, at consequat ipsum gravida ut. Curabitur nec facilisis
                            lacus. Duis et lectus nunc. Donec mollis quam vel tortor congue consequat.</p>

                        <button type="button" class="btn more" id="more" data-toggle="collapse" data-target="#demo">
                            More
                        </button>
                        <div class="collapse" id="demo">
                            <p class="about-history">Aenean bibendum malesuada metus, quis dapibus turpis placerat sit
                                amet. Nulla posuere turpis nibh. Cras faucibus metus ut enim blandit commodo. Quisque
                                porta pharetra vestibulum. Pellentesque sed rutrum urna, a condimentum libero. Integer
                                auctor nibh vel dictum fermentum. Sed dolor elit, vehicula sit amet elit vel, sagittis
                                finibus massa. Vivamus id lectus dui. In pulvinar efficitur iaculis. Suspendisse auctor
                                lorem at nisi ornare sagittis. Suspendisse at sem accumsan turpis viverra aliquam.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!---------------------------------------Menu----------------------------------->

<section class="bg-menu bg-section" id="menu">
    <div class="container-fluid">
        <h1 class="container-h1">Menu</h1>
        <div class="row">

            <!--                Nav pills-->
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#breakfast">Breakfast</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#lunch">Lunch</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#dinner">Diner</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#dessert">Dessert</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#salads">Salads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#drinks">Drinks</a>
                </li>
            </ul>

        </div>
    </div>
</section>


</body>
</html>