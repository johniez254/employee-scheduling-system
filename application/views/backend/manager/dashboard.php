

  <!-- begin DASHBOARD CIRCLE TILES -->

                <div class="row">
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?php echo base_url()."manager/employees" ?>">
                                <div class="circle-tile-heading dark-blue">
                                    <i class="fa fa-users fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content dark-blue">
                                <div class="circle-tile-description text-faded">
                                    Employees
                                </div>
                                <div class="circle-tile-number text-faded">
                                	<?php echo $this->db->count_all('users'); ?>
                                </div>
                                <a href="<?php echo base_url()."manager/employees" ?>" class="circle-tile-footer">More Information <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?php echo base_url().'manager/stations' ?>">
                                <div class="circle-tile-heading blue">
                                    <i class="fa fa-home fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content blue">
                                <div class="circle-tile-description text-faded">
                                    Stations
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?php echo $this->db->count_all('station'); ?>
                                </div>
                                <a href="<?php echo base_url().'manager/stations' ?>" class="circle-tile-footer">More Information <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?php echo base_url().'manager/manage' ?>">
                                <div class="circle-tile-heading green">
                                    <i class="fa fa-list-alt fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content green">
                                <div class="circle-tile-description text-faded">
                                    Shifts
                                </div>
                                <div class="circle-tile-number text-faded">
                                <?php echo $this->db->count_all('shifts');?>
                                </div>
                                <a href="<?php echo base_url().'manager/manage' ?>" class="circle-tile-footer">More Information <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?php echo base_url().'manager/schedule' ?>">
                                <div class="circle-tile-heading purple">
                                    <i class="fa fa-code-fork fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content purple">
                                <div class="circle-tile-description text-faded">
                                    Schedules
                                </div>
                                <div class="circle-tile-number text-faded">
                                <?php echo $this->db->count_all('schedules');?>
                                </div>
                                <a href="<?php echo base_url().'manager/schedule' ?>" class="circle-tile-footer">More Information <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?php echo base_url().'manager/time_off' ?>">
                                <div class="circle-tile-heading orange">
                                    <i class="fa fa-clock-o fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content orange">
                                <div class="circle-tile-description text-faded">
                                    Total Time Offs
                                </div>
                                <div class="circle-tile-number text-faded">
                                <?php echo $this->db->count_all('time_off');?>
                                </div>
                                <a href="<?php echo base_url().'manager/time_off' ?>" class="circle-tile-footer">More Information <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                  
                     <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="<?php echo base_url().'manager/schedule_swap' ?>">
                                <div class="circle-tile-heading red">
                                    <i class="fa fa-refresh fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content red">
                                <div class="circle-tile-description text-faded">
                                    Total Swaps
                                </div>
                                <div class="circle-tile-number text-faded">
                                <?php echo $this->db->count_all('swap');?>
                                </div>
                                <a href="<?php echo base_url().'manager/schedule_swap' ?>" class="circle-tile-footer">More Information <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- end DASHBOARD CIRCLE TILES -->
                
<div class="row">

                    <div class="col-md-4">
                        
                        <div class="portlet portlet-default">
                                    <div class="portlet-heading">
                                        <div class="portlet-title">
                                            <h4><i class="fa fa-circle text-green"></i> Overview</h4>
                                            <?php 
											 $where="schedule_status='0'";
											$this->db->select('shift_id');
											$this->db->from('schedules');
											$this->db->where($where);
											$this->db->distinct('shift_id');
											$count_count_active_shifts=$this->db->count_all_results();
											$all_shifts=$this->db->count_all('shifts');
											//echo $count_count_active_shifts;
											
											//get all stations
											$all_stations=$this->db->count_all('station');
											
											//get stations with shifts
											$this->db->select('station_id');
											$this->db->from('shifts');
											$this->db->distinct('station_id');
											$count_stations_with_shifts=$this->db->count_all_results();
											$all_shifts=$this->db->count_all('shifts');
											
											?>
                                        </div>
                                        <div class="portlet-widgets">
                                            <div class="btn-group">
                                            </div>
                                            <span class="divider"></span>
                                            <a data-toggle="collapse" data-parent="#accordion" href="#chat"><i class="fa fa-chevron-down"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="chat" class="panel-collapse collapse in">
                                        <div class="portlet-body chat-widget">
                                            <div class="row">
                                                <div class="col-xs-2 col-sm-2"> 
                                                    <div class="circle-tile" style="width:10px;">
                                                            <div class="circle-tile-heading green" style="width:40px; height:40px;">
                                                                <p style="font-size:23px; font-weight:bold;">
                                                                	<?php echo $all_stations-$count_stations_with_shifts;?>
                                                                </p>
                                                            </div>
                                                       </div>
                                                    </div>
                                                <div class="col-xs-10 col-sm-10">
                                                	<h4>
                                                    	<strong>
                                                        	<i class="fa fa-home"></i> Stations lack Shifts!
                                                        </strong>
                                                    </h4>
                                                    <p class="pull-right"><a href="<?php echo base_url() ?>manager/stations" class="btn btn-green btn-xs">More Details</a></p>
                                               </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-xs-2 col-sm-2"> 
                                                    <div class="circle-tile" style="width:10px;">
                                                            <div class="circle-tile-heading green" style="width:40px; height:40px;">
                                                                <p style="font-size:23px; font-weight:bold;">
                                                                	<?php echo $all_shifts-$count_count_active_shifts?>
                                                                </p>
                                                            </div>
                                                       </div>
                                                    </div>
                                                <div class="col-xs-12 col-sm-10">
                                                	<h4>
                                                    	<strong>
                                                        	<i class="fa fa-list-alt"></i> Shifts Not Scheduled!
                                                        </strong>
                                                    </h4>
                                                    <p class="pull-right"><a href="<?php echo base_url() ?>manager/manage" class="btn btn-green btn-xs">More Details</a></p>
                                               </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                        
                    </div>
                    <div class="col-lg-4">
                        
                        <div class="portlet portlet-blue">
                                    <div class="portlet-heading">
                                        <div class="portlet-title">
                                            <h4><i class="fa fa-clock-o"></i> Pending Time Offs Requests</h4>
                                        </div>
                                        <div class="portlet-widgets">
                                            <div class="btn-group">
                                            </div>
                                            <span class="divider"></span>
                                            <a data-toggle="collapse" data-parent="#accordion" href="#chat"><i class="fa fa-chevron-down"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="chat" class="panel-collapse collapse in">
                                        <div class="portlet-body chat-widget">
                                        <?php
										$where="request_status='0'";
										$this->db->select('*');
										$this->db->from('time_off');
										$this->db->where($where);
										$count_all_time_off=$this->db->count_all_results();
										
										if($count_all_time_off!="0"){
										$where="request_status='0'";
										$this->db->select('*');
										$this->db->from('time_off');
										$this->db->where($where);
										$this->db->order_by('time_off_id','desc');
										$this->db->join('users', 'users.id = time_off.employee_id');
										$this->db->join('time_off_options', 'time_off_options.option_id = time_off.time_off_options_id');
										$this->db->limit('5');
											$desc	=	$this->db->get()->result_array();
											$i='1';
											foreach($desc as $row):
											
											$time_off_id=$row['time_off_id'];
											$employee_name=$row['fullnames'];
											$login_id=$row['login_id'];
											$request_status=$row['request_status'];
											$d_requested=$row['d_requested'];
											$start_from=$row['start_from'];
											$d_requested=$row['d_requested'];
										?>
                                        
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="media">
                                                        <a class="pull-left" href="#">
                                                            <img class="media-object img-circle" src="<?php echo $this->crud->get_image_url('user',$login_id);?>" alt="<?php echo $employee_name;?>" width="30px">
                                                        </a>
                                                        <div class="media-body">
                                                            <h4 class="media-heading"><?php echo ucwords($employee_name);?>
                                                                <span class="small pull-right"><?php echo date('d/m/Y',$d_requested)?></span>
                                                            </h4>
                                                            <p><strong><?php echo ucwords($employee_name);?></strong> requested for a time off starting from <strong><?php echo date("d/m/Y",$start_from);?></strong></p>
                                                            <p><a href="<?php echo base_url();?>manager/requests/view_time_off/<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($time_off_id))))))))?>;" class="btn btn-xs btn-green pull-right">View Details</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <?php endforeach?>
                                            <?php }else{?>
                                            <p>No pending time off data is available</p>
                                            <?php }?>
                                        </div>
                                        <div class="portlet-footer">
                            				<div class="btn-toolbar" role="toolbar">
                                        		<a href="<?php echo base_url()?>manager/time_off" class="btn btn-blue pull-right">View All Time Offs</a>
                                        	</div>
                                        </div>
                                    </div>
                                </div>
                                                
                    </div>
                    <div class="col-lg-4">
                        
                        <div class="portlet portlet-green">
                                    <div class="portlet-heading">
                                        <div class="portlet-title">
                                            <h4><i class="fa fa-refresh"></i> Pending Swap Requests</h4>
                                        </div>
                                        <div class="portlet-widgets">
                                            <div class="btn-group">
                                            </div>
                                            <span class="divider"></span>
                                            <a data-toggle="collapse" data-parent="#accordion" href="#chat"><i class="fa fa-chevron-down"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="chat" class="panel-collapse collapse in">
                                        <div class="portlet-body chat-widget">
                                             <?php
										$where="s_status='0'";
										$this->db->select('*');
										$this->db->from('swap');
										$this->db->where($where);
										$count_all_swap=$this->db->count_all_results();
										
										if($count_all_swap!="0"){
										$where="s_status='0'";
										$this->db->select('*');
										$this->db->from('swap');
										$this->db->where($where);
										$this->db->order_by('swap_id','desc');
										$this->db->join('users', 'users.id = swap.employee_from');
										//$this->db->join('time_off_options', 'time_off_options.option_id = time_off.time_off_options_id');
										$this->db->limit('5');
											$desc	=	$this->db->get()->result_array();
											$i='1';
											foreach($desc as $row):
											
											$schedule_id=$row['schedule_id'];
											$employee_name=$row['fullnames'];
											$employee_to=$row['employee_to'];
											$login_id=$row['login_id'];
											$s_status=$row['s_status'];
											$date_requested=$row['date_requested'];
											$start_from=$row['s_start_date'];
											$swap_id=$row['swap_id'];
											$employee_to_swap       =	$this->db->get_where('users' , array('id'=>$employee_to))->row()->fullnames;
										?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="media">
                                                        <a class="pull-left" href="#">
                                                            <img class="media-object img-circle" src="<?php echo $this->crud->get_image_url('user',$login_id);?>" alt="<?php echo $employee_name;?>" width="30px">
                                                        </a>
                                                        <div class="media-body">
                                                            <h4 class="media-heading"><?php echo ucwords($employee_name);?>
                                                                <span class="small pull-right"><?php echo date('d/m/Y',$date_requested)?></span>
                                                            </h4>
                                                            <p>Requested for a schedule swap to <strong><?php echo $employee_to_swap;?></strong> starting from <strong><?php echo date("d/m/Y",$start_from);?></strong></p>
                                                            <p><a href="<?php echo base_url();?>manager/requests/view_swap/<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($swap_id))))))))?>;" class="btn btn-xs btn-green pull-right">View Details</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <?php endforeach?>
                                            <?php }else{?>
                                            <p>No pending swap schedule data is available</p>
                                            <?php }?>
                                        </div>
                                        <div class="portlet-footer">
                            				<div class="btn-toolbar" role="toolbar">
                                        		<a href="<?php echo base_url()?>manager/schedule_swap" class="btn btn-green pull-right">View All Swaps</a>
                                        	</div>
                                        </div>
                                    </div>
                                </div>
                        
                    </div>

                </div>
                <!-- /.row -->
                
               