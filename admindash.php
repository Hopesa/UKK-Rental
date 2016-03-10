<?php
/**
 * Created by PhpStorm.
 * User: Hopesa
 * Date: 04/03/2016
 * Time: 04:39
 */

include_once 'config/config.php';

if(!loggedinSpc())
{
    redirect('login.php');
}
if(cekPrivilage()=='1'){
    $privilage = 'Admin';
}
else{
    $privilage = 'Karyaan';
}

?>
<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-->
<!--<html xmlns="http://www.w3.org/1999/xhtml">-->
<!--<head>-->
<!--    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<!--    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />-->
<!--    <link rel="stylesheet" href="style.css" type="text/css"  />-->
<!--    <title>welcome - --><?php //echo($_SESSION['username']); ?><!--</title>-->
<!--</head>-->
<!---->
<!--<body>-->
<!---->
<!--<div class="header">-->
<!--    <div class="left">-->
<!--        <label><a href="http://www.codingcage.com/">Coding Cage - Programming Blog</a></label>-->
<!--    </div>-->
<!--    <div class="right">-->
<!--        <label><a href="login.php?action=logout"><i class="glyphicon glyphicon-log-out"></i> logout</a></label>-->
<!--    </div>-->
<!--</div>-->
<!--<div class="content">-->
<!--    welcome : --><?php // echo $privilage;echo ($_SESSION['username']); ?>
<!--</div>-->
<!--</body>-->
<!--</html>-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Rental Mobil</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!--Icons-->
    <script src="js/lumino.glyphs.js"></script>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php
echo $nav;
echo $sidebar;
?>
<!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg>
                </a>
            </li>
            <li class="active">Icons</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard <?php echo $privilage?></h1>
        </div>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="panel panel-blue panel-widget ">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-4 widget-left">
                        <svg class="glyph stroked male user ">
                            <use xlink:href="#stroked-male-user" />
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">Setoran</div>
                        <div class="text-muted">Manajemen Setoran</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="panel panel-orange panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-4 widget-left">
                        <svg class="glyph stroked chevron left">
                            <use xlink:href="#stroked-chevron-left" />
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">Pelanggan</div>
                        <div class="text-muted">Manajemen</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="panel panel-teal panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-4 widget-left">
                        <svg class="glyph stroked chevron left">
                            <use xlink:href="#stroked-chevron-left" />
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">Reservasi</div>
                        <div class="text-muted">Manajemen Reservasi</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="panel panel-red panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-4 widget-left">
                        <svg class="glyph stroked chevron left">
                            <use xlink:href="#stroked-chevron-left" />
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">25.2k</div>
                        <div class="text-muted">Mobil</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="panel panel-blue panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-4 widget-left">
                        <svg class="glyph stroked male user ">
                            <use xlink:href="#stroked-male-user" />
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">Karyawan</div>
                        <div class="text-muted">Menejemen Employee</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="panel panel-teal panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-4 widget-left">
                        <svg class="glyph stroked chevron left">
                            <use xlink:href="#stroked-chevron-left" />
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">25.2k</div>
                        <div class="text-muted">Mobil</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Site Traffic Overview</div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <h4>New Orders</h4>
                    <div class="easypiechart" id="easypiechart-blue" data-percent="92"><span class="percent">92%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <h4>Comments</h4>
                    <div class="easypiechart" id="easypiechart-orange" data-percent="65"><span class="percent">65%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <h4>New Users</h4>
                    <div class="easypiechart" id="easypiechart-teal" data-percent="56"><span class="percent">56%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <h4>Visitors</h4>
                    <div class="easypiechart" id="easypiechart-red" data-percent="27"><span class="percent">27%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-md-8">

            <div class="panel panel-default chat">
                <div class="panel-heading" id="accordion">
                    <svg class="glyph stroked two-messages">
                        <use xlink:href="#stroked-two-messages"></use>
                    </svg> Chat</div>
                <div class="panel-body">
                    <ul>
                        <li class="left clearfix">
                                <span class="chat-img pull-left">
									<img src="http://placehold.it/80/30a5ff/fff" alt="User Avatar" class="img-circle" />
								</span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">John Doe</strong> <small class="text-muted">32 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ante turpis, rutrum ut ullamcorper sed, dapibus ac nunc. Vivamus luctus convallis mauris, eu gravida tortor aliquam ultricies.
                                </p>
                            </div>
                        </li>
                        <li class="right clearfix">
                                <span class="chat-img pull-right">
									<img src="http://placehold.it/80/dde0e6/5f6468" alt="User Avatar" class="img-circle" />
								</span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="pull-left primary-font">Jane Doe</strong> <small class="text-muted">6 mins ago</small>
                                </div>
                                <p>
                                    Mauris dignissim porta enim, sed commodo sem blandit non. Ut scelerisque sapien eu mauris faucibus ultrices. Nulla ac odio nisl. Proin est metus, interdum scelerisque quam eu, eleifend pretium nunc. Suspendisse finibus auctor lectus, eu interdum sapien.
                                </p>
                            </div>
                        </li>
                        <li class="left clearfix">
                                <span class="chat-img pull-left">
									<img src="http://placehold.it/80/30a5ff/fff" alt="User Avatar" class="img-circle" />
								</span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">John Doe</strong> <small class="text-muted">32 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ante turpis, rutrum ut ullamcorper sed, dapibus ac nunc. Vivamus luctus convallis mauris, eu gravida tortor aliquam ultricies.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-md" placeholder="Type your message here..." />
                            <span class="input-group-btn">
								<button class="btn btn-success btn-md" id="btn-chat">Send</button>
							</span>
                    </div>
                </div>
            </div>

        </div>
        <!--/.col-->

        <div class="col-md-4">

            <div class="panel panel-blue">
                <div class="panel-heading dark-overlay">
                    <svg class="glyph stroked clipboard-with-paper">
                        <use xlink:href="#stroked-clipboard-with-paper"></use>
                    </svg>To-do List</div>
                <div class="panel-body">
                    <ul class="todo-list">
                        <li class="todo-list-item">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox" />
                                <label for="checkbox">Make a plan for today</label>
                            </div>
                            <div class="pull-right action-buttons">
                                <a href="#">
                                    <svg class="glyph stroked pencil">
                                        <use xlink:href="#stroked-pencil"></use>
                                    </svg>
                                </a>
                                <a href="#" class="flag">
                                    <svg class="glyph stroked flag">
                                        <use xlink:href="#stroked-flag"></use>
                                    </svg>
                                </a>
                                <a href="#" class="trash">
                                    <svg class="glyph stroked trash">
                                        <use xlink:href="#stroked-trash"></use>
                                    </svg>
                                </a>
                            </div>
                        </li>
                        <li class="todo-list-item">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox" />
                                <label for="checkbox">Update Basecamp</label>
                            </div>
                            <div class="pull-right action-buttons">
                                <a href="#">
                                    <svg class="glyph stroked pencil">
                                        <use xlink:href="#stroked-pencil"></use>
                                    </svg>
                                </a>
                                <a href="#" class="flag">
                                    <svg class="glyph stroked flag">
                                        <use xlink:href="#stroked-flag"></use>
                                    </svg>
                                </a>
                                <a href="#" class="trash">
                                    <svg class="glyph stroked trash">
                                        <use xlink:href="#stroked-trash"></use>
                                    </svg>
                                </a>
                            </div>
                        </li>
                        <li class="todo-list-item">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox" />
                                <label for="checkbox">Send email to Jane</label>
                            </div>
                            <div class="pull-right action-buttons">
                                <a href="#">
                                    <svg class="glyph stroked pencil">
                                        <use xlink:href="#stroked-pencil"></use>
                                    </svg>
                                </a>
                                <a href="#" class="flag">
                                    <svg class="glyph stroked flag">
                                        <use xlink:href="#stroked-flag"></use>
                                    </svg>
                                </a>
                                <a href="#" class="trash">
                                    <svg class="glyph stroked trash">
                                        <use xlink:href="#stroked-trash"></use>
                                    </svg>
                                </a>
                            </div>
                        </li>
                        <li class="todo-list-item">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox" />
                                <label for="checkbox">Drink coffee</label>
                            </div>
                            <div class="pull-right action-buttons">
                                <a href="#">
                                    <svg class="glyph stroked pencil">
                                        <use xlink:href="#stroked-pencil"></use>
                                    </svg>
                                </a>
                                <a href="#" class="flag">
                                    <svg class="glyph stroked flag">
                                        <use xlink:href="#stroked-flag"></use>
                                    </svg>
                                </a>
                                <a href="#" class="trash">
                                    <svg class="glyph stroked trash">
                                        <use xlink:href="#stroked-trash"></use>
                                    </svg>
                                </a>
                            </div>
                        </li>
                        <li class="todo-list-item">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox" />
                                <label for="checkbox">Do some work</label>
                            </div>
                            <div class="pull-right action-buttons">
                                <a href="#">
                                    <svg class="glyph stroked pencil">
                                        <use xlink:href="#stroked-pencil"></use>
                                    </svg>
                                </a>
                                <a href="#" class="flag">
                                    <svg class="glyph stroked flag">
                                        <use xlink:href="#stroked-flag"></use>
                                    </svg>
                                </a>
                                <a href="#" class="trash">
                                    <svg class="glyph stroked trash">
                                        <use xlink:href="#stroked-trash"></use>
                                    </svg>
                                </a>
                            </div>
                        </li>
                        <li class="todo-list-item">
                            <div class="checkbox">
                                <input type="checkbox" id="checkbox" />
                                <label for="checkbox">Tidy up workspace</label>
                            </div>
                            <div class="pull-right action-buttons">
                                <a href="#">
                                    <svg class="glyph stroked pencil">
                                        <use xlink:href="#stroked-pencil"></use>
                                    </svg>
                                </a>
                                <a href="#" class="flag">
                                    <svg class="glyph stroked flag">
                                        <use xlink:href="#stroked-flag"></use>
                                    </svg>
                                </a>
                                <a href="#" class="trash">
                                    <svg class="glyph stroked trash">
                                        <use xlink:href="#stroked-trash"></use>
                                    </svg>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-md" placeholder="Add new task" />
                            <span class="input-group-btn">
								<button class="btn btn-primary btn-md" id="btn-todo">Add</button>
							</span>
                    </div>
                </div>
            </div>

        </div>
        <!--/.col-->
    </div>
    <!--/.row-->
</div>
<!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chart.min.js"></script>
<script src="js/chart-data.js"></script>
<script src="js/easypiechart.js"></script>
<script src="js/easypiechart-data.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script>
    $('#calendar').datepicker({});

    ! function ($) {
        $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function () {
        if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })
</script>
</body>

</html>