<?php
$user_id= $this->session->userdata('id');
$id=$this->db->get_where('users' , array('login_id'=>$user_id))->row()->id;

$ol="employee_id=".$id."";
$this->db->select('*');
$this->db->from('schedules');
$this->db->where($ol);
$count_schedules	=	$this->db->count_all_results();


$ol="employee_id=".$id."";
$this->db->select('*');
$this->db->from('time_off');
$this->db->where($ol);
$time_off	=	$this->db->count_all_results();

$ol="employee_from=".$id."";
$this->db->select('*');
$this->db->from('swap');
$this->db->where($ol);
$count_swaps	=	$this->db->count_all_results();


$where="employee_id=".$id." AND schedule_status='1'";
$this->db->select_sum('days_assigned');
$this->db->from('schedules');
$this->db->where($where);
$desc=$this->db->get()->result_array();
$worked=0;
foreach($desc as $row):
$worked+=$row['days_assigned'];
endforeach;

?>

  <!-- begin DASHBOARD CIRCLE TILES -->

                <div class="row">
                    <div class="col-lg-3 col-sm-4">
                        <div class="circle-tile">
                            <a href="<?php echo base_url()."user/shifts" ?>">
                                <div class="circle-tile-heading dark-blue">
                                    <i class="fa fa-list-alt fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content dark-blue">
                                <div class="circle-tile-description text-faded">
                                    Shifts
                                </div>
                                <div class="circle-tile-number text-faded">
                                	<?php echo $count_schedules; ?>
                                </div>
                                <a href="<?php echo base_url()."user/shifts" ?>" class="circle-tile-footer">More Information <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-sm-4">
                        <div class="circle-tile">
                            <a href="<?php echo base_url().'user/shifts' ?>">
                                <div class="circle-tile-heading blue">
                                    <i class="glyphicon glyphicon-time fa-3x" style="margin-top:15px;"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content blue">
                                <div class="circle-tile-description text-faded">
                                    Hours Worked
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?php echo $worked*8; ?>
                                </div>
                                <a href="<?php echo base_url().'user/shifts' ?>" class="circle-tile-footer">More Information <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-sm-4">
                        <div class="circle-tile">
                            <a href="<?php echo base_url().'user/shifts' ?>">
                                <div class="circle-tile-heading green">
                                    <i class="fa fa-thumb-tack fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content green">
                                <div class="circle-tile-description text-faded">
                                    Time Off
                                </div>
                                <div class="circle-tile-number text-faded">
                                	<?php echo $time_off;?>
                                </div>
                                <a href="<?php echo base_url().'user/shifts' ?>" class="circle-tile-footer">More Infor <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                  
                     <div class="col-lg-3 col-sm-4">
                        <div class="circle-tile">
                            <a href="<?php echo base_url().'user/schedule_swap' ?>">
                                <div class="circle-tile-heading purple">
                                    <i class="fa fa-refresh fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content purple">
                                <div class="circle-tile-description text-faded">
                                    Schedule Swaps
                                </div>
                                <div class="circle-tile-number text-faded">
                                      <?php echo $count_swaps?>
                                </div>
                                <a href="<?php echo base_url().'user/schedule_swap' ?>" class="circle-tile-footer">More Information <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                </div>
  <!-- end DASHBOARD CIRCLE TILES -->
                
<div class="row">
                    
                        <div class="col-lg-12">
                            <div class="row">
                                 <div class="col-lg-4">
                            <div class="tile green">
                            <center>
                            
                                <h3>Assigned Shift</h3><hr />
                            </center>
                                
                                 <?php
								 $where="employee_id=".$id." AND schedule_status=0";
											$this->db->select('*');
											$this->db->from('schedules');
											$this->db->where($where);
											$active_shift=$this->db->count_all_results();
											if($active_shift!="0"){
												
                                        	$where="employee_id=".$id." AND schedule_status=0";
											$this->db->select('*');
											$this->db->from('schedules');
											$this->db->where($where);
											$this->db->order_by('schedule_id','desc');
											$this->db->join('users', 'users.id = schedules.employee_id');
											$this->db->join('shifts', 'shifts.shift_id = schedules.shift_id');
											$this->db->join('station', 'station.station_id = schedules.station_id');
											$desc	=	$this->db->get()->result_array();
											$i='1';
											foreach($desc as $row):
											$shift_name=$row['shift_name'];
											$start_time=$row['start_time'];
											$end_time=$row['end_time'];
											$duration_from=$row['duration_from'];
											$duration_to=$row['duration_to'];
											$station_name=$row['station_name'];
											?>
                                <center>
                                <h3><?php echo ucwords($station_name); ?> </h3><br />
                                <h4><?php echo $shift_name; ?> (<?php echo date("h:i a",$start_time)?> - <?php echo date("h:i a",$end_time)?>)</h4>
                                <hr />
                                <h4><?php echo date("d/m/Y",$duration_from) ?> - <?php echo date("d/m/Y",$duration_to) ?></h4>
                                </center>
                                
                                            <?php endforeach;?>
                                            
                                            <?php }else{?>
                                            <center>
                                            <h4>You have no Active Shift assigned assigned to you</h4>
                                            <hr />
                                            </center>
                                            <?php }?>
                            </div>
                        </div>
                        <!-- /.col-lg-4 -->
                        
                        <div class="col-lg-4 col-sm-10">
                                
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
										
										$where="s_status='0' AND employee_from=".$id."";
										$this->db->select('*');
										$this->db->from('swap');
										$this->db->where($where);
										$count_all_swap=$this->db->count_all_results();
										
										if($count_all_swap!="0"){
										$where="s_status='0' AND employee_from=".$id."";
										$this->db->select('*');
										$this->db->from('swap');
										$this->db->where($where);
										$this->db->join('users', 'users.id = swap.employee_from');
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
                                                            <p>You have a pending swap request to <strong><?php echo $employee_to_swap;?></strong> starting from <strong><?php echo date("d/m/Y",$start_from);?></strong></p>
                                                            <p><a href="<?php echo base_url();?>user/requests/view_swap/<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($swap_id))))))))?>;" class="btn btn-xs btn-green pull-right">View Details</a></p>
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
                        
                            <div class="col-lg-4 col-sm-6">
                                <div class="portlet portlet-default">
                                    <div class="portlet-heading">
                                        <div class="portlet-title">
                                            <h4><i class="fa fa-circle text-green"></i> Upcoming Time offs</h4>
                                        </div>
                                        <div class="portlet-widgets">
                                            <span class="divider"></span>
                                            <a data-toggle="collapse" data-parent="#accordion" href="#chat"><i class="fa fa-chevron-down"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="chat" class="panel-collapse collapse in">
                                        <div class="portlet-body chat-widget">
                                          <?php
										  if($time_off=="0"){
											  echo '<i class="fa fa-info-circle"></i> No Upcoming time off data available';
										  }else{?>
                                             <div class="table-responsive">
                                                    <table class="table table-hover">
                                                     <thead>
                                            				<tr>
                                                                <th>Duration</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
														
															$where="employee_id=".$id."";
															$this->db->select('*');
															$this->db->from('time_off');
															$this->db->where($where);
															$this->db->limit('1');
															$desc	=	$this->db->get()->result_array();
															foreach($desc as $row):
															$time_off_id=$row['time_off_id'];
															$from=$row['start_from'];
															$to=$row['end_time'];
															$status=$row['request_status'];
														?>
                                                            <tr>
                                                                <td>
                                                                	<?php echo date('m/d/Y',$from);?> - <?php echo date('m/d/Y',$to);?>
                                                                </td>
                                                                <td>
                                                                	<?php if($status=='0'){ echo '<span class="label orange"><i class="fa fa-clock-o"></i> Pending</span>'; }?>
																	<?php if($status=='1'){ echo '<span class="label label-default"><i class="fa fa-arrow-circle-right"></i> Finished</span>'; }?>
                                                                    <?php if($status=='2'){ echo '<span class="label green"><i class="fa fa-check-circle-o"></i> Approved</span>'; }?>
                                                                    <?php if($status=='3'){ echo '<span class="label red"><i class="fa fa-times-circle-o"></i> Declined</span>'; }?>
                                                                </td>
                                                            </tr>
                                                            <?php  endforeach;?>
                                                        </tbody>
                                                    </table>
                                                    </div>
											<?php
										  }
										  ?>
                                            
                                        </div>
                                        <div class="portlet-footer">
                            				<div class="btn-toolbar" role="toolbar">
                                        		<a href="<?php echo base_url()?>manager/time_off" class="btn btn-green pull-right">View All Time Offs</a>
                                        	</div>
                                    </div>
                                </div>
                            </div>
                            
                            
                                                       
                            </div>
                            <!--row-->
                        </div>
                    </div>

                </div>
                <!-- /.row -->