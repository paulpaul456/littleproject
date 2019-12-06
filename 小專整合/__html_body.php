<script>

$( document ).ready(function() {
    let welcome = $('#welcome');
    fetch('https://api.openweathermap.org/data/2.5/weather?q=Taipei&appid=500b5fc68b89851ff95541b5e46645a3')
    .then(response=>{
        console.log(response);
        return response.json();
    })
    .then(json=>{
        console.log(json.weather[0].main);
        welcome.append(`${json.name} &nbsp &nbsp${(json.main.temp-273.15).toFixed(1)}&deg;C &nbsp &nbsp${json.weather[0].description}`)
    })
});
let present = new Date();
let present_day = `${present.getDay()}`;
</script>
<?php
$sql_tt = "SELECT `color` FROM `admin` WHERE `email`=?";

$stmt_tt = $pdo->prepare($sql_tt);

$stmt_tt->execute([
    $_SESSION['loginUser']['email']
]);
$row_tt = $stmt_tt->fetch();
if(empty($row_tt)){
    $color = [];
}else{
    $color = json_decode($row_tt['color']);
}


?>

<body>
    <div class="wrapper ">
        <div class="sidebar" data-color="<?= empty($color[0])? "white" : $color[0] ?>"
            data-active-color="<?= empty($color[1])? "danger" : $color[1] ?>">
            <!--
Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
            <div class="logo">
                <a href="#" class="simple-text logo-mini">
                    <div class="logo-image-small">
                        <img src="../assets/img/farm_logo.png">
                    </div>
                </a>
                <a href="#" class="simple-text logo-normal">
                    OrganFood
                    <!-- <div class="logo-image-big">
    <img src="../assets/img/logo-big.png">
  </div> -->
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="<?= $page_name == "adminhome" ? 'active' : ''; ?>">
                        <a href="../Admin/adminHome.php">
                            <i class="nc-icon nc-bank"></i>
                            <p>Home</p>
                        </a>
                    </li>

                    <li data-toggle="collapse" data-target="#member"
                        class="collapsed 
                        <?= ($page_name == "member_list" or $page_name == "member_insert" or $page_name == "member_edit") ? 'active' : ''; ?>">
                        <a href="#">
                            <i class="nc-icon nc-single-02"></i>
                            <p>Members</p><span class="arrow"></span>
                        </a>
                        </a>
                    </li>

                    <ul class=" sub-menu <?= ($page_name == "member_list" or $page_name == "member_edit" or $page_name == "member_insert") ? '' : 'collapse'; ?>"
                        id="member">
                        <li><a href="../Customer/data_list.php"
                                <?= ($page_name == "member_list") ? 'style="color: orange"' : '' ?>>
                                <p>Data List</p>
                            </a></li>
                        <li><a href="../Customer/data_insert.php"
                                <?= ($page_name == "member_insert") ? 'style="color: orange"' : '' ?>>
                                <p>Addition</p>
                            </a></li>
                    </ul>
                    <li data-toggle="collapse" data-target="#farmer"
                        class="collapsed <?= ($page_name == "farmer" or $page_name == "farmer_edit" or $page_name == "farmer_create" or $page_name == "farmer_product_read" or $page_name == "farmer_product_edit" or $page_name == "farmer_product_insert") ? 'active' : ''; ?>">
                        <a href="#">
                            <i class="nc-icon nc-basket"></i>
                            <p>Farmer</p><span class="arrow"></span>
                        </a>
                        </a>
                    </li>

                    <ul class=" sub-menu <?= ($page_name == "farmer" or $page_name == "farmer_edit" or $page_name == "farmer_create" or $page_name == "farmer_product_read" or $page_name == "farmer_product_edit" or $page_name == "farmer_product_insert") ? '' : 'collapse'; ?>"
                        id="farmer">
                        <li><a href="../Farmers/farmer.php"
                                <?= ($page_name == "farmer" or $page_name == "farmer_edit" or $page_name == "farmer_create") ? 'style="color: orange"' : '' ?>>
                                <p>Data List</p>
                            </a></li>
                        <li><a href="../Farmer_product/farmer_product_read.php"
                                <?= ( $page_name == "farmer_product_read" or $page_name == "farmer_product_edit") ? 'style="color: orange"' : ''; ?>>
                                <p>Product List</p>
                            </a></li>
                        <li><a href="../Farmer_product/farmer_product_insert.php"
                                <?= ( $page_name == "farmer_product_insert") ? 'style="color: orange"' : ''; ?>>
                                <p>Addition</p>
                            </a></li>


                    </ul>
                    <li data-toggle="collapse" data-target="#restaurant"
                        class="collapsed <?= ($page_name == "restaurant_edit" or $page_name == "restaurant_list" or $page_name == "restaurant_insert") ? 'active' : ''; ?>">
                        <a href="#">
                            <i class="nc-icon nc-shop"></i>
                            <p>Restaurant</p><span class="arrow"></span>
                        </a>
                        </a>
                    </li>

                    <ul class=" sub-menu <?= ($page_name == "restaurant_edit" or $page_name == "restaurant_list" or $page_name == "restaurant_insert") ? '' : 'collapse'; ?>"
                        id="restaurant">
                        <li><a href="../Restaurant/restaurant_list.php"
                                <?= ($page_name == "restaurant_edit" or $page_name == "restaurant_list" ) ? 'style="color: orange"' : ''; ?>>
                                <p>Data List</p>
                            </a></li>
                        <li><a href="../Restaurant/restaurant_insert.php"
                                <?= ($page_name == "restaurant_insert") ? 'style="color: orange"' : ''; ?>>
                                <p>Addition</p>
                            </a></li>

                    </ul>
                    <li data-toggle="collapse" data-target="#cookbook"
                        class="collapsed <?= ($page_name == "dinner_edit" or $page_name == "dinner_list" or $page_name == "dinner_insert") ? 'active' : ''; ?>">
                        <a href="#">
                            <i class="nc-icon nc-paper"></i>
                            <p>CookBook</p><span class="arrow"></span>
                        </a>
                        </a>
                    </li>

                    <ul class=" sub-menu <?= ($page_name == "dinner_edit" or $page_name == "dinner_list" or $page_name == "dinner_insert") ? '' : 'collapse'; ?>"
                        id="cookbook">
                        <li><a href="../Cookbook/dinner_list.php"
                                <?= ($page_name == "dinner_edit" or $page_name == "dinner_list" ) ? 'style="color: orange"' : ''; ?>>
                                <p>Data List</p>
                            </a></li>
                        <li><a href="../Cookbook/dinner_insert.php"
                                <?= ($page_name == "dinner_insert") ? 'style="color: orange"' : ''; ?>>
                                <p>Addition</p>
                            </a></li>

                    </ul>
                    <li data-toggle="collapse" data-target="#classroom"
                        class="collapsed <?= ($page_name == "room_data_list" or $page_name == "room_data_edit" or $page_name == "room_data_insert" or $page_name == "room_data_city_list" or $page_name == "room_data_city_insert" or $page_name == "room_data_city_edit") ? 'active' : ''; ?>">
                        <a href="#">
                            <i class="nc-icon-outline location_position-pin"></i>

                            <p>ClassRoom</p><span class="arrow"></span>
                        </a>
                        </a>
                    </li>

                    <ul class=" sub-menu <?= ($page_name == "room_data_list" or $page_name == "room_data_edit" or $page_name == "room_data_insert" or $page_name == "room_data_city_list" or $page_name == "room_data_city_insert" or $page_name == "room_data_city_edit")? '' : 'collapse'; ?>"
                        id="classroom">
                        <li><a href="../Classroom/room_data_list.php"
                                <?= ($page_name == "room_data_list" or $page_name == "room_data_edit") ? 'style="color: orange"' : ''; ?>>
                                <p>Classroom</p>
                            </a></li>
                        <li><a href="../Classroom/room_data_insert.php"
                                <?= ($page_name == "room_data_insert") ? 'style="color: orange"' : ''; ?>>
                                <p>Add classroom</p>
                            </a></li>
                        <li><a href="../Classroom/room_data_city_list.php"
                                <?= ($page_name == "room_data_city_list") ? 'style="color: orange"' : ''; ?>>
                                <p>Dist table</p>
                            </a></li>
                        <li><a href="../Classroom/room_data_city_insert.php"
                                <?= ($page_name == "room_data_city_insert") ? 'style="color: orange"' : ''; ?>>
                                <p>Dist</p>
                            </a></li>
                    </ul>
                    <li data-toggle="collapse" data-target="#course"
                        class="collapsed <?= ($page_name == "course_data_list" or $page_name == "course_data_insert" or $page_name == "course_data_edit") ? 'active' : ''; ?>">
                        <a href="#">
                            <i class="nc-icon-outline food_chef-hat"></i>
                            <p>Course</p><span class="arrow"></span>
                        </a>
                        </a>
                    </li>

                    <ul class=" sub-menu <?= ($page_name == "course_data_list" or $page_name == "course_data_insert" or $page_name == "course_data_edit") ? '' : 'collapse'; ?>"
                        id="course">
                        <li><a href="../Course/course_data_list.php"
                                <?= ($page_name == "course_data_list" or $page_name == "course_data_edit" ) ? 'style="color: orange"' : ''; ?>>
                                <p>List</p>
                            </a></li>
                        <li><a href="../Course/course_data_insert.php"
                                <?= ($page_name == "course_data_insert") ? 'style="color: orange"' : ''; ?>>
                                <p>Addition</p>
                            </a></li>

                    </ul>

                    <li data-toggle="collapse" data-target="#setting"
                        class="collapsed <?= ($page_name == "Account"or $page_name == "adminlayout") ? 'active' : ''; ?>">
                        <a href="#">
                            <i class="nc-icon nc-settings-gear-65"></i>
                            <p>Setting</p><span class="arrow"></span>
                        </a>
                        </a>
                    </li>

                    <ul class=" sub-menu <?= ($page_name == "Account" or $page_name == "adminlayout") ? '' : 'collapse'; ?>"
                        id="setting">
                        <li>
                            <a href="../Admin/admin_edit.php"
                                <?= $page_name == "Account" ? 'style="color: orange"' : ''; ?>>
                                <p>Account</p>
                            </a></li>
                        <li><a href="../Admin/admin_layout.php"
                                <?= $page_name == "adminlayout" ? 'style="color: orange"' : ''; ?>>
                                <p>Layout</p>
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
                        <?php if($page_name=='adminhome'): ?>
                        <a id="welcome" style="letter-spacing:1px;transition:1s">
                        <!-- Hey , <p style="font-size:20px">
                        <?= $_SESSION['loginUser']['nickname']?> </p> 
                        Today is <p style="font-size:20px"><?= date("l")?></p> </a> -->
                                <?php endif ?>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <!-- <form>
                        <div class="input-group no-border ">
                            <input type="text" value="" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <div class="input-group-text">

                                </div>
                            </div>
                        </div>
                    </form> -->
                        <ul class="navbar-nav">
                            <li class="nav-item btn-rotate dropdown">
                                <a class="nav-link" href="" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">

                                    <i class="nc-icon nc-bell-55 position-relative "
                                        style="filter: drop-shadow(5px 5px 20px 20px black)">
                                        <div class="position-absolute bell_notice" id="bell_notice" style=""></div>
                                    </i>
                                    <!-- <i class="far fa-bell fa-lg"></i> -->
                                    <!-- <i class="fas fa-bell fa-lg"></i> -->
                                    <p>
                                        <span class="d-lg-none d-md-block">Notice</span>
                                    </p>
                                </a>
                                <div id="notice-dropdown" class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="navbarDropdownMenuLink">
                                    <!-- <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a> -->
                                </div>
                            </li>
                            <li class="nav-item btn-rotate dropdown">
                                <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span><?= $_SESSION['loginUser']['nickname'] ?></span>
                                    <p>
                                        <span class="d-lg-none d-md-block"></span>
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="../Admin/admin_edit.php">Account Setting</a>
                                    <a class="dropdown-item" href="../Admin/logout.php">Log Out</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn-rotate" href="../Admin/admin_layout.php">
                                    <i class="nc-icon nc-settings-gear-65"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Setting</span>
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <script>
            
            </script>
            <?php include '../__html_breadCrumb.php' ?>