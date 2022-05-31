<?php 
    if(isset($_GET['subpage']))
    {
        $subPage = $_GET['subpage'];
    }
    //U odnosu na subpage parametar menja se navigacioni bar
?>
<body id="reportsPage">
    <div class="" id="home">
        <nav class="navbar navbar-expand-xl">
            <div class="container h-100">
                <a class="navbar-brand" href="./index.php?page=home">
                <h1 class="tm-site-title mb-0"><img src="assets/images/ds-logo.png" alt="siteLogo"/></h1>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto h-100">
                        <li class="nav-item">
                            <a class="nav-link <?php if(!isset($subPage)) echo"active" ?>" href="index.php?page=admin">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <?php if(isset($_SESSION['user'])): 
                         if($_SESSION['user']->role_id == 1): ?>
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-file-alt"></i>
                                <span>
                                    Reports <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="index.php?page=admin&subpage=servers">Servers</a>
                                <a class="dropdown-item" href="index.php?page=admin&subpage=serverStatus">My Server</a>
                                <a class="dropdown-item" href="#">Export</a>
                                <a class="dropdown-item" href="#">Import</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=admin&subpage=web-dev">
                                <i class="fas fa-laptop"></i>
                                Web-Dev Requests
                            </a>
                        </li>
                        <?php else: ?>
                            <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-server"></i>
                                <span>
                                    Server <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="index.php?page=admin&subpage=serverStatus">Server Status</a>
                                <a class="dropdown-item" href="#">Server Documentation</a>
                            </div>
                        </li>
                        <?php endif; endif; ?>
                       
                            <li class="nav-item">
                                <a class="nav-link  <?php if(isset($subPage) && ($subPage == "account")) echo"active" ?>" href="index.php?page=admin&subpage=account">
                                 <i class="far fa-user"></i>
                                 Account<?php if(isset($_SESSION['user']) && ($_SESSION['user']->role_id == 1)) echo "s"; ?>
                                </a>
                            </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-block" href="?page=logout">
                                <?php if($_SESSION['user']->role_id == 1):?>
                                    Admin, <b>Logout</b>
                                <?php else:?>
                                    User, <b>Logout</b>
                                <?php endif; ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>
        <div class="container">
    <div class="row">
                <div class="col">
                    <?php if($_SESSION['user']->role_id == 1): ?>
                        <p class="text-white mt-5 mb-5">Welcome back, <b>Admin</b></p>
                    <?php else: ?>
                        <p class="text-white mt-5 mb-5">Welcome back, <b>User</b></p>
                    <?php endif; ?>
                </div>
    </div>