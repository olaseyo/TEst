<?php
 @header('Access-Control-Allow-Origin: *');
@header('Access-Control-Allow-Methods: GET, POST'); 

include('functions.php');

$_SESSION['uid']=$_GET['uid'];
$_SESSION['email']=$_GET['email'];
$_SESSION['token']=$_GET['token'];


 if (!$_SESSION['uid']){
	//header('location:index.php');
}
$data=Get_All_Data("select * from register where uid=".$_SESSION['uid']."",$dbc);
//print_r($data);


$profile=Get_All_Data("select * from personal_info 
JOIN financial_info on financial_info.uid=personal_info.uid
Join register on financial_info.uid=register.uid where register.uid=".$_SESSION['uid']."",$dbc);
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from avenxo.kaijuthemes.com/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 30 Dec 2016 08:24:56 GMT -->
<head>
    <meta charset="utf-8">
    <title>ZeeBucks</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Avenxo Admin Theme">
    <meta name="author" content="KaijuThemes">
 <link type='text/css' href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600' rel='stylesheet'>

    <link type="text/css" href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">        <!-- Font Awesome -->
    <link type="text/css" href="assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">              <!-- Themify Icons -->
    <link type="text/css" href="assets/css/styles.css" rel="stylesheet">                                     <!-- Core CSS with all styles -->

    <link type="text/css" href="assets/plugins/codeprettifier/prettify.css" rel="stylesheet">                <!-- Code Prettifier -->
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">              <!-- iCheck -->

<link type="text/css" href="assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet"> 						<!-- FullCalendar -->
<link type="text/css" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"> 			<!-- jVectorMap -->
<link type="text/css" href="assets/plugins/switchery/switchery.css" rel="stylesheet">   			
    </head>

    <body class="animated-content">
        
        <header id="topnav" class="navbar navbar-default navbar-fixed-top" role="banner" style="box-shadow: 0px 2px 19px 0px black;">

	<div class="logo-area">
		<span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg">
			<a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar">
				<span class="icon-bg">
					<i class="ti ti-menu"></i>
				</span>
			</a>
		</span>
		
		<a class="navbar-brand" href="index.php">ZeeBucks</a>

		<div class="toolbar-icon-bg hidden-xs" id="toolbar-search">
            <div class="input-group">
            	<span class="input-group-btn"><button class="btn" type="button"><i class="ti ti-search"></i></button></span>
				<input type="text" class="form-control" placeholder="Search...">
				<span class="input-group-btn"><button class="btn" type="button"><i class="ti ti-close"></i></button></span>
			</div>
        </div>

	</div><!-- logo-area -->

	<ul class="nav navbar-nav toolbar pull-right">

		<li class="toolbar-icon-bg visible-xs-block" id="trigger-toolbar-search">
			<a href="#"><span class="icon-bg"><i class="ti ti-search"></i></span></a>
		</li>

        <li class="dropdown toolbar-icon-bg hidden-xs">
			<a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><span class="icon-bg"><i class="ti ti-email"></i></span><span
			class="badge badge-deeporange">2</span></a>
			<div class="dropdown-menu notifications arrow">
				<div class="topnav-dropdown-header">
					<span>Messages</span>
				</div>
				<div class="scroll-pane">
					<ul class="media-list scroll-content">
						<li class="media notification-message">
							<a href="#">
								<div class="media-left">
									<img class="img-circle avatar" src="assets/img/admin.png" alt="" />
								</div>
								<div class="media-body">
									<h4 class="notification-heading"><strong>Vincent Keller</strong> <span class="text-gray">‒ Design should be ...</span></h4>
									<span class="notification-time">2 mins ago</span>
								</div>
							</a>
						</li>
						
					</ul>
				</div>
				<div class="topnav-dropdown-footer">
					<a href="#">See all messages</a>
				</div>
			</div>
		</li>
		
		<li class="dropdown toolbar-icon-bg">
			<a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><span class="icon-bg"><i class="ti ti-bell"></i></span><span class="badge badge-deeporange">2</span></a>
			<div class="dropdown-menu notifications arrow">
				<div class="topnav-dropdown-header">
					<span>Notifications</span>
				</div>
				<div class="scroll-pane">
					<ul class="media-list scroll-content">
						<li class="media notification-success">
							<a href="#">
								<div class="media-left">
									<span class="notification-icon"><i class="ti ti-check"></i></span>
								</div>
								<div class="media-body">
									<h4 class="notification-heading">Update 1.0.4 successfully pushed</h4>
									<span class="notification-time">8 mins ago</span>
								</div>
							</a>
						</li>
						<li class="media notification-info">
							<a href="#">
								<div class="media-left">
									<span class="notification-icon"><i class="ti ti-check"></i></span>
								</div>
								<div class="media-body">
									<h4 class="notification-heading">Update 1.0.3 successfully pushed</h4>
									<span class="notification-time">24 mins ago</span>
								</div>
							</a>
						</li>
					
					</ul>
				</div>
				<div class="topnav-dropdown-footer">
					<a href="#">See all notifications</a>
				</div>
			</div>
		</li>

		<li class="dropdown toolbar-icon-bg">
			<a href="#" class="dropdown-toggle username" data-toggle="dropdown">
				<img class="img-circle" src="<?php echo 'http://stableflexers.com/zeebucks/uploads/'.$_SESSION['email']."/".$profile[0]['profile_pic']; ?>" height="100" alt="" />
			</a>
			<ul class="dropdown-menu userinfo arrow">
				<li><a href="profile.php"><i class="ti ti-user"></i><span>Profile</span><span class="badge badge-info pull-right">80%</span></a></li>
				
				<li><a href="#/"><i class="ti ti-shift-right"></i><span>Sign Out</span></a></li>
			</ul>
		</li>

	</ul>

</header>

        <div id="wrapper">
            <div id="layout-static">
                <div class="static-sidebar-wrapper sidebar-default">
                    <div class="static-sidebar">
                        <div class="sidebar">
	<div class="widget">
        <div class="widget-body">
            <div class="userinfo">
                <div class="avatar">
                   <img class="img-circle" src="<?php echo 'http://stableflexers.com/zeebucks/uploads/'.$_SESSION['email']."/".$profile[0]['profile_pic']; ?>" height="100" alt="" />
                </div>
                <div class="info">
                    <span class="username"><?php echo $profile[0]['name'] ?></span>
                    <span class="useremail"><?php echo $profile[0]['email'] ?></span>
                </div>
            </div>
        </div>
    </div>
	<div class="widget stay-on-collapse" id="widget-sidebar">
        <nav role="navigation" class="widget-body">
	<ul class="acc-menu">
		<li class="nav-separator"><span>Navigation</span></li>
		
			<li><a href="#" onclick="Load_Page('http://stableflexers.com/zeebucks/dashboard.php?')"><i class="ti ti-home"></i><span>Dashboard</span></a></li>
		
		
		<li><a href="#" onclick="Load_Page('http://stableflexers.com/zeebucks/profile.php?')"><i class="fa fa-user"></i><span>Profile</span></span></a></li>
		<li><a href="#" onclick="Load_Page('http://stableflexers.com/zeebucks/earnings.php?')"><i class="fa fa-money"></i><span>Earnings</span></span></a></li>
		<li><a href="#" onclick="Load_Page('http://stableflexers.com/zeebucks/play.php?')"><i class="fa fa-caret-square-o-right"></i><span>Play</span></span></a></li>
		<li><a href="#" onclick="Load_Page('http://stableflexers.com/zeebucks/recharge_wallet.php?')"><i class="fa fa-bank"></i><span>Wallet</span></span></a></li>
		<li><a href="#" onclick="Load_Page('http://stableflexers.com/zeebucks/withdraw.php?')"><i class="fa fa-chevron-circle-right"></i><span>Withdraw</span></span></a></li>
		<li><a href="#" onclick="Load_Page('http://stableflexers.com/zeebucks/inbox.php?')"><i class="fa fa-envelope"></i><span>Inbox</span></span> <span class="badge badge-teal"><?php $msg_count=Get_All_Data("select * from send_message where reciever_id=".$_SESSION['uid']." and `read`=0",$dbc); echo count($msg_count); ?></span></a></li>
		

	</ul>
</nav>
    </div>

</div>
                    </div>
                </div>
                <div class="static-content-wrapper">
                    <div class="static-content">
                        <div class="page-content">
                            <ol class="breadcrumb">
                                
<li class=""><a href="index.html">Home</a></li>
<li class="active"><a href="index.html">Dashboard</a></li>

                            </ol>