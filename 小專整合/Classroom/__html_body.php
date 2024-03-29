<body>
<div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
        <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                <div class="logo-image-small">
                    <img src="assets/img/farm_logo.png">
                </div>
            </a>
            <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                OrganFood
                <!-- <div class="logo-image-big">
        <img src="../assets/img/logo-big.png">
      </div> -->
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="<?= $page_name == "adminHome" ? 'active' : ''; ?>">
                    <a href="adminHome.php">
                        <i class="nc-icon nc-bank"></i>
                        <p>Home</p>
                    </a>
                </li>

                <li  data-toggle="collapse" data-target="#service" class="collapsed <?= $page_name == "class" ? 'active' : ''; ?>">
                    <a href="#">
                        <i class="nc-icon nc-single-02"></i>
                        <p>Class</p><span class="arrow"></span></a>
                    </a>
                </li>

                <ul class=" sub-menu <?= $page_name == "class" ? '' : 'collapse'; ?>" id="service">
                    <li><a href="room_data_list.php">
                            <p>Classroom overview</p>
                        </a></li>
                    <li ><a href="room_data_insert.php" <?= $page_name == "class" ? 'style="color: orange"' : ''; ?>>
                            <p>Add classroom</p>
                        </a></li>
                    <li ><a href="room_data_city_list.php" <?= $page_name == "class" ? 'style="color: orange"' : ''; ?>>
                            <p>Dist table</p>
                        </a></li>
                    <li ><a href="room_data_city_insert.php" <?= $page_name == "class" ? 'style="color: orange"' : ''; ?>>
                            <p>Add Dist</p>
                        </a></li>
                </ul>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="#pablo">Admin Interface</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <form>
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <!-- <i class="nc-icon nc-zoom-split"></i> -->
                                </div>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link btn-magnify" href="#pablo">
                                <i class="nc-icon nc-layout-11"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Stats</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item btn-rotate dropdown">
                            <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="nc-icon nc-bell-55"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Some Actions</span>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn-rotate" href="#pablo">
                                <i class="nc-icon nc-settings-gear-65"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Account</span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
<?php include __DIR__ . '/__html_breadCrumb.php' ?>