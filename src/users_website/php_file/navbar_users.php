<nav id="navbaruser" class="navbar navbar-expand-lg fixed-top bg-dark navbar-dark px-3 mb-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="#myPage">Shrek's Restaurant</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-grow-1 text-right" id="navbar">
            <!--    #about - go to another section with this id-->
            <ul class="nav nav-pills ms-auto flex-nowrap">
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <?php echo $_SESSION['userName'] ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark bg-dark">
                        <li><a class="dropdown-item" href="orders.php">Orders</a></li>
                        <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                        <li>
                            <hr class="dropdown-divider bg-secondary">
                        </li>
                        <li><a class="dropdown-item"
                               href="../../../src/users_website/php_file/logout.php">Log out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>