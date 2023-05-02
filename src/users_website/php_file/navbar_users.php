<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
    <a class="navbar-brand" href="#myPage">Shrek's Restaurant</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <!--    #about - go to another section with this id-->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#menu">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#service">Service</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#contact">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../../src/users_website/php_file/logout.php"><?php echo $_SESSION['userName']?></a>
            </li>
        </ul>
    </div>
</nav>