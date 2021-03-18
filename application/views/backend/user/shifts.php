<?php
$user_id= $this->session->userdata('id');
$id=$this->db->get_where('users' , array('login_id'=>$user_id))->row()->id;

$ol="employee_id=".$id."";
$this->db->select('*');
$this->db->from('time_off');
$this->db->where($ol);
$count_time_off	=	$this->db->count_all_results();

$ol="employee_id=".$id."";
$this->db->select('*');
$this->db->from('schedules');
$this->db->where($ol);
$count_all_schedules	=	$this->db->count_all_results();

$ol="employee_id=".$id." AND schedule_status='1'";
$this->db->select('*');
$this->db->from('schedules');
$this->db->where($ol);
$count_completed_schedules	=	$this->db->count_all_results();

$ol="employee_id=".$id." AND schedule_status='0'";
$this->db->select('*');
$this->db->from('schedules');
$this->db->where($ol);
$count_active_schedules	=	$this->db->count_all_results();

$ol="employee_id=".$id." AND request_status='2'";
$this->db->select('*');
$this->db->from('time_off');
$this->db->where($ol);
$count_approved_time_off	=	$this->db->count_all_results();

$ol="employee_id=".$id." AND request_status='3'";
$this->db->select('*');
$this->db->from('time_off');
$this->db->where($ol);
$count_declined_time_off	=	$this->db->count_all_results();
?>

 <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Shifts / Schedules</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab">Schedules</a>
                                    </li>
                                    <li><a href="#profile" data-toggle="tab">All Shifts</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="home">
                                          <!-- begin PAGE TITLE ROW -->
                            
                                            <div class="row">
                            
                                                <div class="col-lg-4">
                                                    <div class="portlet portlet-green">
                                                        <div class="portlet-heading">
                                                            <div class="portlet-title">
                                                                <h4>Overview</h4>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="portlet-body">
                                                            
                                                            <div class="list-group">
                                                                <a href="#" class="list-group-item active">Overview</a>
                                                                <a href="#" class="list-group-item">Schedule Status:<span class="badge green">
                                                                
                                                                <?php if($count_active_schedules!="0"){
																	$where="employee_id=".$id." AND schedule_status='0'";
																	$this->db->select('*');
																	$this->db->from('schedules');
																	$this->db->where($where);
																	$desc	=	$this->db->get()->result_array();
																	$i='1';
																	foreach($desc as $row):
																	$schedule_status=$row['schedule_status'];
																	
																	if($schedule_status=='0'){echo "active";}else{echo "Finished";}
																	
																	endforeach;		
																}else{
																	echo "Not Assigned";
																}
																?>
                                                                </span></a>
                                                                <a href="#" class="list-group-item">Completed Schedules:<span class="badge orange"><?php echo $count_completed_schedules;?></span></a>
                                                                <a href="#" class="list-group-item">Current Assigned Station:<span class="badge orange">
                                                                <?php if($count_active_schedules!="0"){
																	$where="employee_id=".$id." AND schedule_status='0'";
																	$this->db->select('*');
																	$this->db->from('schedules');
																	$this->db->where($where);
																	$this->db->join('station', 'station.station_id = schedules.station_id');
																	$desc	=	$this->db->get()->result_array();
																	$i='1';
																	foreach($desc as $row):
																	$station_name=$row['station_name'];
																	
																	echo $station_name;
																	
																	endforeach;		
																}else{
																	echo "None";
																}
																?>
                                                                </span></a>
                                                                <a href="#" class="list-group-item">Shift:<span class="badge blue">
																	<?php if($count_active_schedules!="0"){
                                                                        $where="employee_id=".$id." AND schedule_status='0'";
                                                                        $this->db->select('*');
                                                                        $this->db->from('schedules');
                                                                        $this->db->where($where);
                                                                        $this->db->join('shifts', 'shifts.shift_id = schedules.shift_id');
                                                                        $desc	=	$this->db->get()->result_array();
                                                                        $i='1';
                                                                        foreach($desc as $row):
                                                                        $start_time=$row['start_time'];
                                                                        $end_time=$row['end_time'];
                                                                        
                                                                        echo "(".date("h:i a",$start_time)." - ".date("h:i a",$end_time).")";
                                                                        
                                                                        endforeach;		
                                                                    }else{
                                                                        echo "None";
                                                                    }
                                                                    ?>
                                                                </span></a>
                                                                <a href="#" class="list-group-item">Date Ending:<span class="badge blue">
																	<?php if($count_active_schedules!="0"){
                                                                        $where="employee_id=".$id." AND schedule_status='0'";
                                                                        $this->db->select('*');
                                                                        $this->db->from('schedules');
                                                                        $this->db->where($where);
                                                                        $desc	=	$this->db->get()->result_array();
                                                                        $i='1';
                                                                        foreach($desc as $row):
                                                                        $duration_to=$row['duration_to'];
                                                                        
                                                                        echo date("m/d/Y",$duration_to);
                                                                        
                                                                        endforeach;		
                                                                    }else{
                                                                        echo "Null";
                                                                    }
                                                                    ?>
                                                                </span></a>
                                                            </div>
                                                            <br />
                                                            <div class="list-group">
                                                                <a href="<?php echo base_url()?>user/time_off" class="list-group-item active">Time Off</a>
                                                                <a href="#" class="list-group-item">Time Off Status:<?php
																if($count_time_off!=0){
																	$where="employee_id=".$id." AND time_off_status='0'";
                                                                    $this->db->select('*');
                                                                    $this->db->from('time_off');
                                                                    $this->db->where($where);
                                                                    $desc	=	$this->db->get()->result_array();
                                                                    foreach($desc as $row):
																		$time_off_status=$row['request_status'];
																		if($time_off_status=="0"){
																			echo '<span class="badge orange">Pending</span>';
																		}
																		if($time_off_status=="1"){
																			echo '<span class="badge default">Finished</span>';
																		}
																		if($time_off_status=="2"){
																			echo '<span class="badge green">Approved</span>';
																		}
																		if($time_off_status=="3"){
																			echo '<span class="badge red">Declined</span>';
																		}
																?>
                                                                <?php endforeach?>
                                                                <?php }else{?>
                                                                	Not yet requested
                                                                <?php }?></a>
                                                                <a href="#" class="list-group-item">Offs Requested:<span class="badge blue"><?php echo $count_time_off;?></span></a>
                                                                <a href="#" class="list-group-item">Total Days Off:<span class="badge blue">
                                                                <?php
																if($count_time_off!="0"){
                                                                    $where="employee_id=".$id."";
                                                                    $this->db->select('*');
                                                                    $this->db->from('time_off');
                                                                    $this->db->where($where);
                                                                    $desc	=	$this->db->get()->result_array();
                                                                    foreach($desc as $row):
																		$start_time=$row['start_from'];
																		$end_time=$row['end_time'];
																		
																		//convert dates to string
																		$st=date('m/d/Y',$start_time);
																		$et=date('m/d/Y',$end_time);
																		
																		//get date difference
																		$start=new DateTime($st);
																		$end=new DateTime($et);
																		$interval=$start->diff($end);
																		
																		//get output
																		$output=$interval->format('%a days');
																		echo $output;
																	?>
                                                                    <?php endforeach?>
                                                                    <?php }else{?>
                                                                    0 days
                                                                    <?php }?>
                                                                </span></a>
                                                                
                                                                <a href="#" class="list-group-item">Approved:<span class="badge green"><?php echo $count_approved_time_off; ?></span></a>
                                                                <a href="#" class="list-group-item">Rejected<span class="badge red"><?php echo $count_declined_time_off;?></span></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.col-lg-4 -->
                            
                                                <div class="col-lg-8">
                                                    <div class="portlet portlet-green">
                                                        <div class="portlet-heading">
                                                            <div class="portlet-title">
                                                                <h4>My Calendar</h4>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="table-responsive">
                                                                <div id="calendar"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.col-lg-8 -->
                            
                                            </div>
                                            <!-- /.row -->

                                    </div>
                                    <div class="tab-pane fade" id="profile">
                                    
                                    
                                    <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i> Print
                                                    </a>
                                    	</div>
                                    </div>
                                    
                                        <div class="table-responsive">
                                        
                                    
                                    <div id="printer">
                                                	
                                    <table id="example-table" class="table table-striped table-bordered table-hover table-green">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th>Station/Shift</th>
                                                <th>Employee</th>
                                                <th>Duration</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        	$where="employee_id=".$id."";
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
											$schedule_id=$row['schedule_id'];
											$employee_name=$row['fullnames'];
											$shift_name=$row['shift_name'];
											$start_time=$row['start_time'];
											$end_time=$row['end_time'];
											$duration_from=$row['duration_from'];
											$duration_to=$row['duration_to'];
											$station_name=$row['station_name'];
											$schedule_status=$row['schedule_status'];
											?>
                                        <tr class="odd gradeX">
                                            	<td><?php echo $i++; ?></td>
                                                <td>STATION: <p class="label blue"><?php echo $station_name; ?></p><br />
                                                &nbsp&nbsp&nbsp&nbsp&nbsp
												SHIFT: <p class="label blue"><?php echo $shift_name.'&nbsp;('.date("h:i a",$start_time)."&nbsp;-&nbsp;".date("h:i a",$end_time).")"?></p></td>
                                                <td><?php echo $employee_name; ?></td>
                                                <td><?php echo date("m/d/Y",$duration_from); ?> - <?php echo date("m/d/Y",$duration_to); ?></td>
                                                <td>
												<?php if($schedule_status=='0'){ echo '<span class="label green">Active</span>'; }?>
                                                <?php if($schedule_status=='1'){ echo '<span class="label orange">Finished</span>'; }?></td>
                                                <td>
                                                	 <div class="btn-group">
                                                                                <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown">Action
                                                                                    <span class="caret"></span>
                                                                                </button>
                                                                                <ul class="dropdown-menu" role="menu" style="text-align:left; widows:20px;">
                                                                                   <li>action</li>
                                                                                </ul>
                                                                            </div>
                                                            <!-- /btn-group -->
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                    </div>
                                                
                                                </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.portlet-body -->
                        </div>
                        <!-- /.portlet -->
                        
                        
                