<?php
$id		 =	$this->session->userdata('id');
$role       =	$this->db->get_where('login' , array('id'=>$id))->row()->role; 

$username       =	$this->db->get_where('login' , array('id'=>$id))->row()->username;
?>
  
<?php if($role=='manager'){ ?>
				<!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                <i class="fa fa-arrow-circle-right"></i> <?php echo ucwords($page_title);?>
                            </h1>
                            <?php if($crumb=='2'){?>
                            <ol class="breadcrumb">
                                <li  class="active"><i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()."manager/dashboard" ?>">Dashboard</a>
                                </li>
                                <li  class="active"> <a href="<?php echo base_url()."manager/".$function."" ?>"><?php echo $page_crumb;?></a>
                                </li>
                                <li class="active"><?php echo $page_title; ?></li>
                            </ol>
							
							<?php }else{?>                            
                            <ol class="breadcrumb">
                                <li  class="active"><i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()."manager/dashboard" ?>">Dashboard</a>
                                </li>
                                <li class="active"><?php echo ucwords($page_title); ?></li>
                            </ol>
                            <?php }?>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->
                
                
                
                
                
                <?php }elseif($role=='user'){?>
                	<!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1> <i class="fa fa-arrow-circle-right"></i> 
                                <?php echo $page_title; ?>
                            </h1>
                             <?php if($crumb=='2'){?>
                            <ol class="breadcrumb">
                                <li  class="active"><i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()."user/dashboard" ?>">Dashboard</a>
                                </li>
                                <li  class="active"> <a href="<?php echo base_url()."user/".$function."" ?>"><?php echo $page_crumb;?></a>
                                </li>
                                <li class="active"><?php echo $page_title; ?></li>
                            </ol>
							
							<?php }else{?>                            
                            <ol class="breadcrumb">
                                <li  class="active"><i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()."user/dashboard" ?>">Dashboard</a>
                                </li>
                                <li class="active"><?php echo ucwords($page_title); ?></li>
                            </ol>
                            <?php }?>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->
                
                  <?php }else{?>
                
				<?php } ?>
				
                
                