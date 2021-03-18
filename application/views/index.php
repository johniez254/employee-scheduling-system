<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$system_abbr       =	$this->db->get_where('settings' , array('id'=>'1'))->row()->abbr;
$id		 =	$this->session->userdata('id');
$role       =	$this->db->get_where('login' , array('id'=>$id))->row()->role; 

$username       =	$this->db->get_where('login' , array('id'=>$id))->row()->username;
?>



<?php if($role=='manager'){ ?>										

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $system_abbr?> - <?php echo ucwords($page_title);?></title>
	<?php include 'includes_top.php'; ?>
</head>
<link rel="icon" href="<?php echo base_url()?>uploads/favicon.png" type="image/gif">
<body>

<!--begin#wrapper-->
<div id="wrapper">
			<!-- begin SIDE NAVIGATION -->
        <nav class="navbar-side" role="navigation">
            <div class="navbar-collapse sidebar-collapse collapse">
                <ul id="side" class="nav navbar-nav side-nav">
                    <!-- begin SIDE NAV USER PANEL -->
                    <li class="side-user hidden-xs">
                        <img class="img-circle" src="<?php echo $this->crud->get_image_url('user',$id);?>"  alt="" width="150" height="150">
                        <p class="welcome">
                            <i class="fa fa-key"></i> logged_in_as
                        </p>
                        <?php if($role=='manager'){ ?>
                        <p class="name tooltip-sidebar-logout">
                            <?php echo $username; ?>
                            <span class="last-name"><?php echo $role; ?></span> <a style="color: inherit" class="logout_open" href="#logout" data-toggle="tooltip" data-placement="top" title="Logout"><i class="fa fa-sign-out"></i></a>
                        </p>
                        <?php }else{?>
							<p class="name tooltip-sidebar-logout">
                            Johnson
                            <span class="last-name"><?php echo $role; ?></span> <a style="color: inherit" class="logout_open" href="#logout" data-toggle="tooltip" data-placement="top" title="Logout"><i class="fa fa-sign-out"></i></a>
                        </p>
							<?php } ?>
                        <div class="clearfix"></div>
                    </li>
                    <!-- end SIDE NAV USER PANEL -->
                    <!-- begin DASHBOARD LINK -->
                    
                    <li>
                        <a href="<?php echo base_url()."manager/dashboard" ?>" <?php if($page_name=='dashboard'){echo 'class="active"';} ?>>
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>
                    <!-- end DASHBOARD LINK --> 
                    <!-- begin Stations LINK -->
                    
                    <li>
                        <a href="<?php echo base_url()."manager/stations" ?>" <?php if($page_name=='stations' || $page_name=='view_station'){echo 'class="active"';} ?>>
                            <i class="fa fa-home"></i> Stations
                        </a>
                    </li>
                    <!-- end Stations LINK -->
                    <!-- begin Employees LINK -->
                    
                    <li>
                        <a href="<?php echo base_url()."manager/employees" ?>" <?php if($page_name=='employees'){echo 'class="active"';} ?>>
                            <i class="fa fa-users"></i> Employees
                        </a>
                    </li>
                    <!-- end Employees LINK -->
                    
                     <!-- begin shifts CENTER DROPDOWN -->
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#inventory">
                            <i class="fa fa-refresh"></i> Shifts <i class="fa fa-caret-down"></i>
                        </a>
                        
                        <?php if($page_name=='manage_shifts' || $page_name=='manage_schedules'){
							echo'<ul class="collapse nav in" id="inventory">';}
							else {echo'<ul class="collapse nav" id="inventory">';}
						 ?>
                        
                            <li>
                                <a href="<?php echo base_url()."manager/manage" ?>" <?php if($page_name=='manage_shifts'){echo 'class="active"';} ?>>
                                    <i class="fa fa-angle-double-right"></i> Manage Shifts
                                </a>
                            </li>
                            <!--end of gen_settings--> <!--start lang_settings-->
                            <li>
                                <a href="<?php echo base_url()."manager/schedule"?>" <?php if($page_name=='manage_schedules'){echo 'class="active"';} ?>>
                                    <i class="fa fa-angle-double-right"></i> Manage Schedules
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- end shifts CENTER DROPDOWN -->
                    
                     <!-- begin shifts CENTER DROPDOWN -->
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#requests">
                            <i class="fa fa-shield"></i> Requests <i class="fa fa-caret-down"></i>
                        </a>
                        
                        <?php if($page_name=='time_off' || $page_name=='schedule_swap' || $page_name=='view_swaps' || $page_name=='view_time_off'){
							echo'<ul class="collapse nav in" id="requests">';}
							else {echo'<ul class="collapse nav" id="requests">';}
						 ?>
                            <li>
                                <a href="<?php echo base_url()."manager/time_off"?>" <?php if($page_name=='time_off' || $page_name=='view_time_off'){echo 'class="active"';} ?>>
                                    <i class="fa fa-angle-double-right"></i> Time Off
                                </a>
                            </li>
                            <!--Manage Schedules-->
                            <li>
                                <a href="<?php echo base_url()."manager/schedule_swap"?>" <?php if($page_name=='schedule_swap' || $page_name=='view_swaps'){echo 'class="active"';} ?>>
                                    <i class="fa fa-angle-double-right"></i> Schedule Swaps
                                </a>
                            </li>
                            <!--Manage Schedules-->
                        </ul>
                    </li>
                    <!-- end shifts CENTER DROPDOWN -->
                    
                    <!-- begin Settings LINK -->
                    
                    <li>
                        <a href="<?php echo base_url()."manager/reports" ?>" <?php if($page_name=='reports'){echo 'class="active"';} ?>>
                            <i class="fa fa-bar-chart-o"></i> Reports
                        </a>
                    </li>
                    <!-- end Settings LINK -->                  
                    
                                             
                                                           
                </ul>
                <!-- /.side-nav -->
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <!-- /.navbar-side -->
        <!-- end SIDE NAVIGATION -->
		<!-- begin MAIN PAGE CONTENT -->
        
        <div id="page-wrapper">
			<?php include 'nav_top.php' ?>
            <div class="page-content">
            <?php include 'header.php'?>
            
            <?php include 'backend/'.$role.'/'.$page_name.'.php';?>
            <?php include 'footer.php'; ?>
            
            </div>
            
   		</div>
        <!-- end MAIN PAGE CONTENT -->
</div>
<!--end #wrapper -->
	<?php include 'logout.php' ?>
	<?php include 'modal.php' ?>
	<?php include 'includes_bottom.php'; ?>
    
</body>
</html>



<?php } else {?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $system_abbr?> - <?php echo ucwords($page_title);?></title>
	<?php include 'includes_top.php'; ?>
</head>
<link rel="icon" href="<?php echo base_url()?>uploads/favicon.png" type="image/gif">
<body>

<!--begin#wrapper-->
<div id="wrapper">
			<!-- begin SIDE NAVIGATION -->
        <nav class="navbar-side" role="navigation">
            <div class="navbar-collapse sidebar-collapse collapse">
                <ul id="side" class="nav navbar-nav side-nav">
                    <!-- begin SIDE NAV USER PANEL -->
                    <li class="side-user hidden-xs">
                        <img class="img-circle" src="<?php echo $this->crud->get_image_url('user',$id);?>"  alt="" width="150" height="150">
                        <p class="welcome">
                            <i class="fa fa-key"></i> logged_in_as
                        </p>
                        <?php if($role=='user'){ ?>
                        <p class="name tooltip-sidebar-logout">
                            <?php echo $username; ?>
                            <span class="last-name"><?php echo $role; ?></span> <a style="color: inherit" class="logout_open" href="#logout" data-toggle="tooltip" data-placement="top" title="Logout"><i class="fa fa-sign-out"></i></a>
                        </p>
                        <?php }else{?>
							<p class="name tooltip-sidebar-logout">
                            Johnson
                            <span class="last-name"><?php echo $role; ?></span> <a style="color: inherit" class="logout_open" href="#logout" data-toggle="tooltip" data-placement="top" title="Logout"><i class="fa fa-sign-out"></i></a>
                        </p>
							<?php } ?>
                        <div class="clearfix"></div>
                    </li>
                    <!-- end SIDE NAV USER PANEL -->
                    <!-- begin DASHBOARD LINK -->
                    
                    <li>
                        <a href="<?php echo base_url()."user/dashboard" ?>" <?php if($page_name=='dashboard'){echo 'class="active"';} ?>>
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>
                    <!-- end DASHBOARD LINK --> 
                    <!-- begin shift LINK -->
                    
                    <li>
                        <a href="<?php echo base_url()."user/shifts" ?>" <?php if($page_name=='shifts'){echo 'class="active"';} ?>>
                            <i class="fa fa-windows"></i> Shifts
                        </a>
                    </li>
                    <!-- end shift LINK -->
                    
                     <!-- begin requests CENTER DROPDOWN -->
                    <li class="panel">
                        <a href="javascript:;" data-parent="#side" data-toggle="collapse" class="accordion-toggle" data-target="#inventory">
                            <i class="fa fa-refresh"></i> Requests <i class="fa fa-caret-down"></i>
                        </a>
                        
                        <?php if($page_name=='time_off' || $page_name=='schedule_swap' || $page_name=='view_time_off'){
							echo'<ul class="collapse nav in" id="inventory">';}
							else {echo'<ul class="collapse nav" id="inventory">';}
						 ?>
                        
                            <li>
                                <a href="<?php echo base_url()."user/time_off" ?>" <?php if($page_name=='time_off' || $page_name=='view_time_off'){echo 'class="active"';} ?>>
                                    <i class="fa fa-angle-double-right"></i> Time Off
                                </a>
                            </li>
                            <!--end of gen_settings--> <!--start lang_settings-->
                            <li>
                                <a href="<?php echo base_url()."user/schedule_swap"?>" <?php if($page_name=='schedule_swap'){echo 'class="active"';} ?>>
                                    <i class="fa fa-angle-double-right"></i> Schedule Swap
                                </a>
                            </li>
                            <!--end lang_settings-->
                        </ul>
                    </li>
                    <!-- end requests CENTER DROPDOWN -->
                    
                    <!-- begin Reports LINK -->
                    
                    <li>
                        <a href="<?php echo base_url()."user/reports" ?>" <?php if($page_name=='reports'){echo 'class="active"';} ?>>
                            <i class="fa fa-bar-chart-o"></i> Reports
                        </a>
                    </li>
                    <!-- end reports LINK -->
                                     
                    
                                             
                                                           
                </ul>
                <!-- /.side-nav -->
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <!-- /.navbar-side -->
        <!-- end SIDE NAVIGATION -->
		<!-- begin MAIN PAGE CONTENT -->
        
        <div id="page-wrapper">
			<?php include 'nav_top.php' ?>
            <div class="page-content">
            <?php include 'header.php'?>
            
            <?php include 'backend/'.$role.'/'.$page_name.'.php';?>
            <?php include 'footer.php'; ?>
            
            </div>
            
   		</div>
        <!-- end MAIN PAGE CONTENT -->
</div>
<!--end #wrapper -->
	<?php include 'logout.php' ?>
	<?php include 'modal.php' ?>
	<?php include 'includes_bottom.php'; ?>
    
</body>
</html>




 <?php }?>