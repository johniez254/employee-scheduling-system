 <?php foreach($time_off_id->result() as $row):
$time_off_id=$row->time_off_id;
$start_from=$row->start_from;
$end_time=$row->end_time;
$d_requested=$row->d_requested;
$employee_id=$row->employee_id;
$time_off_options_id=$row->time_off_options_id;
$reason=$row->reason;
$request_status=$row->request_status;
$time_off_status=$row->time_off_status;

endforeach;
$login_id=$this->session->userdata('id');
$names       =	$this->db->get_where('users' , array('id'=>$employee_id))->row()->fullnames;
$option_name       =	$this->db->get_where('time_off_options' , array('option_id'=>$time_off_options_id))->row()->option_name;

$ol="employee_id=".$employee_id."";
$this->db->select('*');
$this->db->from('time_off');
$this->db->where($ol);
$count_time_off	=	$this->db->count_all_results();

$ol="employee_id=".$employee_id." AND time_off_status='2' AND time_off_status!='3'";
$this->db->select('*');
$this->db->from('time_off');
$this->db->where($ol);
$count_time_off_finished	=	$this->db->count_all_results();

?>
<div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                        <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Time Off Details</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">


									<div class="row">
                                            <div class="col-lg-2 col-md-3">
                                            <br>
                                                    <img class="img-responsive img-profile" src="<?php echo $this->crud->get_image_url('user',$login_id);?>" alt="<?php echo $names;?>">
                                                <div class="list-group">
                                                    <a href="#" class="list-group-item active">Overview</a>
                                                    <a href="<?php echo base_url()?>user/time_off" class="list-group-item">Requests<span class="badge purple"><?php echo $count_time_off;?></span></a>
                                                    
                                                    	<?php
														if($request_status=="0"){echo '<a href="#" class="list-group-item">Pending
															<span class="badge orange"><i class="fa fa-clock-o"></i></span>
                                                    		</a>';}
														if($request_status=="1"){echo '<a href="#" class="list-group-item">Finished
															<span class="badge default"><i class="fa fa-check"></i></span>
                                                    		</a>';}
														if($request_status=="2"){echo '<a href="#" class="list-group-item">Approved
															<span class="badge green"><i class="fa fa-check"></i></span>
                                                    		</a>';}
														if($request_status=="4"){echo '<a href="#" class="list-group-item">Declined
															<span class="badge red"><i class="fa fa-times"></i></span>
                                                    		</a>';}
														?>
                                                    </a>
                                                    <?php if($request_status=="0"){?>
                                                    <a href="#" class="list-group-item">Off Days<span class="badge blue">
                                                    <?php
													$st=date('m/d/Y',$start_from);
													$et=date('m/d/Y',$end_time);
													
														$start=new DateTime($st);
														$end=new DateTime($et);
														$interval=$start->diff($end);
														$days_difference=$interval->format('%d');
														
														echo $days_difference;
													?>
                                                    </span></a>
                                                    <?php }?>
                                                    
                                                    <a href="<?php echo base_url()?>user/time_off" class="list-group-item">Finished<span class="badge blue"><?php echo $count_time_off_finished;?></span></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-7 col-md-5">
                                                <h2><?php echo $names;?></h2>
                                                <hr>
                                                
                                            <div class="well well-sm"><strong>Request Dates:</strong></div>
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>Start Date</strong></td>
                                                                <td>
                                                                	<?php
																		echo date('m/d/Y',$start_from);
																	?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>End Date</strong></td>
                                                                <td>
                                                                	<?php
																		echo date('m/d/Y',$end_time);
																	?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Total Days Requested</strong></td>
                                                                <td> <a class="btn btn-xs btn-blue disabled"><i class="fa fa-clock-o"> </i> 
                                                                	<?php
																		$st=date('m/d/Y',$start_from);
																		$et=date('m/d/Y',$end_time);
																		
																			$start=new DateTime($st);
																			$end=new DateTime($et);
																			$interval=$start->diff($end);
																			$days_difference=$interval->format('%d');
																			
																			echo $days_difference. ' Days';
																		?>
                                                                        </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="well well-sm"><strong>Reason/Approval Status:</strong></div>
                                                    <table class="table table-hover">
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>Reason</strong></td>
                                                                <td>
                                                                	<?php
																		if($time_off_options_id=="0"){
																			echo $reason;
																		}else{
																			echo $option_name;
																		}
																	?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Status</strong></td>
                                                                <td>
                                                                	<?php
																		if($request_status=="0"){
																			echo'<a class="btn btn-xs btn-orange disabled"><i class="fa fa-clock-o"></i> Pending</a>';
																		}
																		if($request_status=="1"){
																			echo'<a class="btn btn-xs btn-default disabled"><i class="fa fa-check"></i> Finished</a>';
																		}
																		if($request_status=="2"){
																			echo'<a class="btn btn-xs btn-green disabled"><i class="fa fa-check"></i> Approved</a>';
																		}
																		if($request_status=="3"){
																			echo'<a class="btn btn-xs btn-red disabled"><i class="fa fa-times"></i> Declined</a>';
																		}
																	?>
                                                                </td>
                                                            </tr>
                                                            <?php
																if($request_status=="2"){
															?>
                                                                <tr>
                                                                    <td><strong>Approved by</strong></td>
                                                                    <td>
                                                                       <a class="btn btn-xs btn-purple disabled">Manager</a> 
                                                                    </td>
                                                                </tr>
                                                            <?php
																}
															?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                            <br>
                                            <h4>Time Off Radar</h4>
                                            <hr>
                                                        <?php
															$today_date=date('m/d/Y');
															$when_to_start=date("m/d/Y",$start_from);
															$when_to_end=date("m/d/Y",$end_time);
															$s_d_requested=date("m/d/Y",$d_requested);
															
															$start=new DateTime($s_d_requested);
															$end=new DateTime($when_to_start);
															$interval=$start->diff($end);
															$t_days_difference=$interval->format('%d');
															
															$start=new DateTime($today_date);
															$end=new DateTime($when_to_start);
															$interval=$start->diff($end);
															$days_difference=$interval->format('%d');
															$r_difference=$interval->format('%R');
															 
															if($r_difference=="+"){
															if($request_status=="0" or $request_status=="2"){
															$percentage=($days_difference/$t_days_difference)*100;
														
															?>
                                                            <a href="#">
                                                                <p>
                                                                    <?php if($request_status=="0"){echo "Pending Days Remaining";}else{echo "Your Days to Time Off";}?>
                                                                    <span class="pull-right">
                                                                        <strong><?php echo $days_difference;?></strong>
                                                                    </span>
                                                                </p>
                                                                <div class="progress progress-striped active">
                                                                    <div class="progress-bar  <?php if($request_status=="0"){echo "progress-bar-warning";}?>" role="progressbar" aria-valuenow="<?php echo $percentage;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentage;?>%;"></div>
                                                                </div>
                                                            </a>
                                                        	
                                                        <?php }else{?>
															 <a href="#">
                                                                    <p>
                                                                        Remaining Days
                                                                        <span class="pull-right">
                                                                            <strong>0</strong>
                                                                        </span>
                                                                    </p>
                                                                    <div class="progress">
                                                                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                                                    </div>
                                                                </a>
														<?php }?>
														<?php }else{
															
															$start=new DateTime($when_to_start);
															$end=new DateTime($when_to_end);
															$interval=$start->diff($end);
															$b_days_difference=$interval->format('%d');
															$b_r_difference=$interval->format('%R');
															
															//$timeline_percentage=($days_difference/$b_days_difference)*100;
															//echo $b_days_difference;
															
															$start=new DateTime($today_date);
															$end=new DateTime($when_to_end);
															$interval=$start->diff($end);
															$remaining_days=$interval->format('%d');
															//$remaining_days=$interval->format('%R');
															
															$timeline_percentage=($remaining_days/$b_days_difference)*100;
															//echo $b_days_difference;
															
															?>
                                                            
															 <a href="#">
                                                                    <p>
                                                                        Days left
                                                                        <span class="pull-right">
                                                                            <strong><?php echo $b_days_difference;?> Days</strong>
                                                                        </span>
                                                                    </p>
                                                                    <div class="progress">
                                                                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $timeline_percentage?>%;"></div>
                                                                    </div>
                                                                </a>
                                                                <?php }?>
                                            	 
                                             <hr>
                                             	<center>
                                                <?php if($request_status=="0"):?>
                                                    <div class="btn-group">
                                                        <a class="btn btn-blue" onclick="showAjaxModalSmall('<?php echo base_url();?>user/requests/edit/<?php echo $time_off_id;?>');"><i class="fa fa-edit"></i> Edit</a>
                                                    </div>
                                                    <?php endif?>
                                                    <div class="btn-group">
                                                        <a class="btn btn-default" href="<?php echo base_url()?>user/time_off"><i class="fa fa-arrow-circle-right"></i> All Time Offs</a>
                                                    </div>
                                                 </center>
                                            </div>
                                        </div>
                                        
                                        
                                        
                              </div>
                          </div>
                      </div>
                  </div>
