<?php 
if(isset($_SESSION['donationms_userid'])){

    $aid = (isset($_SESSION["donationms_userid"]) ? $_SESSION["donationms_userid"]:0);
    $sql = "select * from tbluser where AID={$aid}";
    $result = mysqli_query($con,$sql) or die("SQL a Query");
    $row = mysqli_fetch_array($result);

    $profile_img = roothtml.'lib/images/user.png';
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>KyoungUnity IT Solution</title>
    <link rel="apple-touch-icon" href="<?php echo roothtml.'lib/images/apple-icon-120.png'?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo roothtml.'lib/images/apple-icon-120.png'?>">
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet"> -->

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo roothtml.'lib/app-assets/vendors/css/vendors.min.css'?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo roothtml.'lib/app-assets/vendors/css/weather-icons/climacons.min.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo roothtml.'lib/app-assets/fonts/meteocons/style.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo roothtml.'lib/app-assets/vendors/css/charts/morris.css'?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo roothtml.'lib/app-assets/vendors/css/charts/chartist.css'?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo roothtml.'lib/app-assets/vendors/css/charts/chartist-plugin-tooltip.css'?>">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo roothtml.'lib/app-assets/css/bootstrap.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo roothtml.'lib/app-assets/css/bootstrap-extended.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo roothtml.'lib/app-assets/css/colors.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo roothtml.'lib/app-assets/css/components.css'?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo roothtml.'lib/app-assets/vendors/css/forms/icheck/icheck.css'?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo roothtml.'lib/app-assets/vendors/css/forms/icheck/custom.css'?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo roothtml.'lib/app-assets/css/plugins/forms/checkboxes-radios.css'?>">

    <link rel="stylesheet" type="text/css"
        href="<?php echo roothtml.'lib/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css'?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo roothtml.'lib/app-assets/vendors/css/forms/toggle/switchery.min.css'?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo roothtml.'lib/app-assets/fonts/simple-line-icons/style.min.css'?>">
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/app-assets/css/plugins/forms/switch.css'?>">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="<?php echo roothtml.'lib/app-assets/css/core/menu/menu-types/vertical-menu-modern.css'?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo roothtml.'lib/app-assets/css/core/colors/palette-gradient.css'?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo roothtml.'lib/app-assets/fonts/simple-line-icons/style.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo roothtml.'lib/app-assets/css/pages/timeline.css'?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo roothtml.'lib/app-assets/css/pages/dashboard-ecommerce.css'?>">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo roothtml.'lib/assets/css/style.css'?>">
    <!-- END: Custom CSS-->

    <!-- Sweet Alarm -->
    <link href="<?=roothtml.'lib/sweet_v2/sweetalert2.min.css' ?>" rel="stylesheet" />
    <script src="<?=roothtml.'lib/sweet_v2/sweetalert2.min.js' ?>"></script>
    <!-- for print -->
    <link href="<?php echo roothtml.'lib/print.min.css' ?>" rel="stylesheet" />
    <!-- Select2 -->
    <link rel="stylesheet" type="text/css"
        href="<?=roothtml.'lib/app-assets/vendors/css/forms/selects/select2.min.css'?>">

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    <nav
        class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-lg-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item mr-auto"><a class="navbar-brand" href="<?=roothtml.'home/home.php'?>"><img
                                class="brand-logo" alt="modern admin logo"
                                src="<?php echo roothtml.'lib/images/apple-icon-120.png'?>">
                            <h3 class="brand-text">HITUPMM</h3>
                        </a></li>
                    <li class="nav-item d-none d-lg-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0"
                            data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white"
                                data-ticon="ft-toggle-right"></i></a></li>
                    <li class="nav-item d-lg-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
                            data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i
                                    class="ficon ft-maximize"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item"><a
                                class="dropdown-toggle nav-link dropdown-user-link" href="#"
                                data-toggle="dropdown"><span
                                    class="mr-1 user-name text-bold-700"><?=$_SESSION["donationms_username"]?></span><span
                                    class="avatar avatar-online"><img src="<?=$profile_img?>"
                                        alt="avatar"><i></i></span></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="<?=roothtml.'user/profile.php'?>"><i class="ft-user"></i>
                                    Edit Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" id="btnlogout"><i class="ft-power"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->

    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="<?=(curlink == 'home.php')?'active':''?>">
                    <a href="<?=roothtml.'home/home.php'?>"><i class="la la-home"></i><span class="menu-title"
                            data-i18n="Dashboard">Dashboard</span></a>
                </li>
                <li class=" nav-item">
                    <a href="#"><i class="la la-dollar"></i><span class="menu-title"
                            data-i18n="Components">အလှူငွေဖြတ်ပိုင်း</span></a>
                    <ul class="menu-content">
                        <li class="<?=(curlink == 'category.php')?'active':''?>">
                            <a class="menu-item " href="<?=roothtml.'category/category.php'?>">
                                <i></i><span data-i18n="Alerts">Manage Category</span>
                            </a>
                        </li>
                        <li class="<?=(curlink == 'storehome.php' || curlink == 'store.php')?'active':''?>">
                            <a class="menu-item " href="<?=roothtml.'category/storehome.php'?>">
                                <i></i><span data-i18n="Alerts">ဦးခန္တီဘုရားရှိစာရင်းများ</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?=(curlink == 'item.php')?'active':''?>"><a href="<?=roothtml.'item/item.php'?>">
                        <i class="ft-plus-circle"></i><span class="menu-title"
                            data-i18n="Shop">အလှူပစ္စည်းစာရင်းများ</span></a>
                </li>
                <li class=" nav-item">
                    <a href="#"><i class="la la-dollar"></i><span class="menu-title"
                            data-i18n="Components">ပစ္စည်းစာရင်းသွင်းရန်</span></a>
                    <ul class="menu-content">
                        <li class="<?=(curlink == 'category.php')?'active':''?>">
                            <a class="menu-item " href="<?=roothtml.'category/category.php'?>">
                                <i></i><span data-i18n="Alerts">Manage Category</span>
                            </a>
                        </li>
                        <li class="<?=(curlink == 'storehome.php' || curlink == 'store.php')?'active':''?>">
                            <a class="menu-item " href="<?=roothtml.'category/storehome.php'?>">
                                <i></i><span data-i18n="Alerts">ဦးခန္တီဘုရားရှိစာရင်းများ</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?=(curlink == 'user.php' || curlink == 'profile.php')?'active':''?>"><a
                        href="<?=roothtml.'user/user.php'?>">
                        <i class="ft-users"></i><span class="menu-title" data-i18n="Shop">အကောင့်အသုံးပြုရန်</span></a>
                </li>
                <li class="<?=(curlink == 'log.php')?'active':''?>">
                    <a href="<?=roothtml.'log/log.php'?>"><i class="la la-binoculars">
                        </i><span class="menu-title" data-i18n="Dashboard">Log History</span></a>
                </li>
            </ul>
        </div>
    </div>

    <!-- END: Main Menu-->

    <?php } else{  header("location:". roothtml."errorpage.php"); } ?>