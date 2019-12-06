<?php
require '../__admin_required.php';
require  '../__connect_db.php';
$page_name = 'adminlayout';
$page_title = 'Layout';
?>
<?php include  '../__html_head.php' ?>
<?php include  '../__html_body.php' ?>
<div class="content mt-n4" style="height:85vh" data-color="">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-11 col-sm-11 card card-user fixed-plugin mt-n5 position-relative">
            <div class="col-md-2 position-absolute" style="top:10px; right:50px">
                <div class=" success-positioning">

                </div>
            </div>
            <ul class=" show pl-0 pt-3" x-placement="top-start" style="width:100% ;height:350px">
                <li class="header-title"> Sidebar Background</li>
                <li class="">
                    <a class="switch-trigger background-color">
                        <div class="badge-colors text-center ">
                            <span class="badge filter badge-light active" id='color1' data-color="white"></span>
                            <span class="badge filter badge-dark " data-color="black"></span>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li class="header-title"> Sidebar Active Color</li>
                <li class="text-center">
                    <a class="switch-trigger active-color">
                        <span class="badge filter badge-primary" data-color="primary"></span>
                        <span class="badge filter badge-info" data-color="info"></span>
                        <span class="badge filter badge-success active" data-color="success"></span>
                        <span class="badge filter badge-warning" data-color="warning"></span>
                        <span class="badge filter badge-danger" data-color="danger"></span>
                    </a>
                </li>
                <li class="button-container col-md-6 mx-auto">
                    <a href="javascript:setColor();" class="btn btn-primary btn-block btn-round">Decorate Your Own</a>
                </li>

            </ul>

        </div>
    </div>
</div>
</div>
</div>
<script>
const success = document.querySelector('.success-positioning')
const succes_icon_str = `<div class="success-icon">
                            <div class="success-icon__tip"></div>
                            <div class="success-icon__long"></div>
                        </div>`;

function setColor() {
    let color1 = $('a.background-color span.active').data('color');
    let color2 = $('a.active-color span.active').data('color');
    // console.log('yes');
    fetch(`admin_layout_api.php?color1=${color1}&color2=${color2}`)
        .then(response => {
            console.log(response);
            return response.json()
        })
        .then(json => {
            console.log(json.get);
            // location.href="adminHome.php"
            success.innerHTML = succes_icon_str;
            setTimeout(() => {
                success.innerHTML = '';
            }, 1500);
        })

}

$(document).ready(function() {

    $sidebar = $('.sidebar');
    $sidebar_img_container = $sidebar.find('.sidebar-background');

    // $full_page = $('.full-page');

    // $sidebar_responsive = $('body > .navbar-collapse');
    // sidebar_mini_active = true;

    // window_width = $(window).width();

    // fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

    // if( window_width > 767 && fixed_plugin_open == 'Dashboard' ){
    //     if($('.fixed-plugin .dropdown').hasClass('show-dropdown')){
    //         $('.fixed-plugin .dropdown').addClass('show');
    //     }
    //
    // }

    // $('.fixed-plugin a').click(function(event) {
    //     // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
    //     if ($(this).hasClass('switch-trigger')) {
    //         if (event.stopPropagation) {
    //             event.stopPropagation();
    //         } else if (window.event) {
    //             window.event.cancelBubble = true;
    //         }
    //     }
    // });

    $('.fixed-plugin .active-color span').click(function() {
        $full_page_background = $('.full-page-background');

        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var new_color = $(this).data('color');

        if ($sidebar.length != 0) {
            $sidebar.attr('data-active-color', new_color);
        }

        // if ($full_page.length != 0) {
        //     $full_page.attr('data-active-color', new_color);
        // }

        // if ($sidebar_responsive.length != 0) {
        //     $sidebar_responsive.attr('data-active-color', new_color);
        // }
    });

    $('.fixed-plugin .background-color span').click(function() {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        var new_color = $(this).data('color');

        if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
        }

        // if ($full_page.length != 0) {
        //     $full_page.attr('filter-color', new_color);
        // }

        // if ($sidebar_responsive.length != 0) {
        //     $sidebar_responsive.attr('data-color', new_color);
        // }
    });

    $('.fixed-plugin .img-holder').click(function() {
        $full_page_background = $('.full-page-background');

        $(this).parent('li').siblings().removeClass('active');
        $(this).parent('li').addClass('active');


        var new_image = $(this).find("img").attr('src');

        if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length !=
            0) {
            $sidebar_img_container.fadeOut('fast', function() {
                $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                $sidebar_img_container.fadeIn('fast');
            });
        }

        // if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
        //     var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

        //     $full_page_background.fadeOut('fast', function() {
        //         $full_page_background.css('background-image', 'url("' + new_image_full_page +
        //             '")');
        //         $full_page_background.fadeIn('fast');
        //     });
        // }

        if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
        }

        if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
        }
    });

    $('.switch-sidebar-image input').on("switchChange.bootstrapSwitch", function() {
        // $full_page_background = $('.full-page-background');

        $input = $(this);

        if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
                $sidebar_img_container.fadeIn('fast');
                $sidebar.attr('data-image', '#');
            }

            // if ($full_page_background.length != 0) {
            //     $full_page_background.fadeIn('fast');
            //     $full_page.attr('data-image', '#');
            // }

            background_image = true;
        } else {
            if ($sidebar_img_container.length != 0) {
                $sidebar.removeAttr('data-image');
                $sidebar_img_container.fadeOut('fast');
            }

            // if ($full_page_background.length != 0) {
            //     $full_page.removeAttr('data-image', '#');
            //     $full_page_background.fadeOut('fast');
            // }

            background_image = false;
        }
    });




});
</script>
<?php include  '../__html_foot.php' ?>