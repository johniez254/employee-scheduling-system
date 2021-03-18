 <?php foreach($swap_id->result() as $row):
$swap_id=$row->swap_id;
$schedule_id=$row->schedule_id;
$employee_from=$row->employee_from;
$employee_to=$row->employee_to;
$s_start_date=$row->s_start_date;
$s_end_date=$row->s_end_date;
$date_requested=$row->date_requested;
$time_off_options_id=$row->time_off_options_id;
$reason=$row->reason;
$s_status=$row->s_status;
endforeach;

//$login_id=$this->session->userdata('id');
$login_id=$this->db->get_where('users' , array('id'=>$employee_from))->row()->login_id;
$names       =	$this->db->get_where('users' , array('id'=>$employee_from))->row()->fullnames;
$names_to       =	$this->db->get_where('users' , array('id'=>$employee_to))->row()->fullnames;
$option_name       =	$this->db->get_where('time_off_options' , array('option_id'=>$time_off_options_id))->row()->option_name;


$ol="employee_from=".$employee_from."";
$this->db->select('*');
$this->db->from('swap');
$this->db->where($ol);
$count_all_swaps	=	$this->db->count_all_results();

$ol="employee_from=".$employee_from." AND s_status='4'";
$this->db->select('*');
$this->db->from('swap');
$this->db->where($ol);
$count_time_off_finished	=	$this->db->count_all_results();
?>

<div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                        <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Swap Details</h4>
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
                                                    <a href="<?php echo base_url()?>manager/schedule_swap" class="list-group-item">Swaps<span class="badge purple"><?php echo $count_all_swaps;?></span></a>
                                                    
                                                    	<?php
														if($s_status=="0"){echo '<a href="#" class="list-group-item">Pending
															<span class="badge orange"><i class="fa fa-clock-o"></i></span>
                                                    		</a>';}
														if($s_status=="1"){echo '<a href="#" class="list-group-item">Approved
															<span class="badge green"><i class="fa fa-check"></i></span>
                                                    		</a>';}
														if($s_status=="4"){echo '<a href="#" class="list-group-item">Approved
															<span class="badge default"><i class="fa fa-check"></i></span>
                                                    		</a>';}
														if($s_status=="3"){echo '<a href="#" class="list-group-item">Declined
															<span class="badge red"><i class="fa fa-times"></i></span>
                                                    		</a>';}
														?>
                                                    </a>
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
                                                                <td><strong>Date Requested</strong></td>
                                                                <td>
                                                                	<?php
																		echo date('m/d/Y',$date_requested);
																	?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Swap To</strong></td>
                                                                <td>
                                                                	<?php
																		echo $names_to;
																	?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Start Date</strong></td>
                                                                <td>
                                                                	<?php
																		echo date('m/d/Y',$s_start_date);
																	?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>End Date</strong></td>
                                                                <td>
                                                                	<?php
																		echo date('m/d/Y',$s_end_date);
																	?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Days</strong></td>
                                                                <td> <a class="btn btn-xs btn-blue disabled"><i class="fa fa-clock-o"> </i> 
                                                                	<?php
																		$st=date('m/d/Y',$s_start_date);
																		$et=date('m/d/Y',$s_end_date);
																		
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
																		if($s_status=="0"){
																			echo'<a class="btn btn-xs btn-orange disabled"><i class="fa fa-clock-o"></i> Pending</a>';
																		}
																		if($s_status=="4"){
																			echo'<a class="btn btn-xs btn-default disabled"><i class="fa fa-check"></i> Finished</a>';
																		}
																		if($s_status=="1"){
																			echo'<a class="btn btn-xs btn-green disabled"><i class="fa fa-check"></i> Approved</a>';
																		}
																		if($s_status=="3"){
																			echo'<a class="btn btn-xs btn-red disabled"><i class="fa fa-times"></i> Declined</a>';
																		}
																	?>
                                                                </td>
                                                            </tr>
                                                            <?php
																if($s_status=="1"){
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
															$when_to_start=date("m/d/Y",$s_start_date);
															$when_to_end=date("m/d/Y",$s_end_date);
															$d_requested=date("m/d/Y",$date_requested);
															
															$start=new DateTime($d_requested);
															$end=new DateTime($when_to_start);
															$interval=$start->diff($end);
															$total_difference=$interval->format('%d');
															
															$start=new DateTime($today_date);
															$end=new DateTime($when_to_start);
															$interval=$start->diff($end);
															$days_difference=$interval->format('%d');
															$r_difference=$interval->format('%R');
															 
															if($r_difference=="+"){
															if($s_status=="0" or $s_status=="1"){
															$percentage=($days_difference/$total_difference)*100;
														
															?>
                                                            <a href="#">
                                                                <p>
                                                                    <?php if($s_status=="0"){echo "Pending Days Remaining";}else{echo "Your Days to Swap Off";}?>
                                                                    <span class="pull-right">
                                                                        <strong><?php echo $days_difference;?></strong>
                                                                    </span>
                                                                </p>
                                                                <div class="progress progress-striped active">
                                                                    <div class="progress-bar  <?php if($s_status=="0"){echo "progress-bar-warning";}?>" role="progressbar" aria-valuenow="<?php echo $percentage;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentage;?>%;"></div>
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
															
															$timeline_percentage=($days_difference/$b_days_difference)*100;
															echo $b_days_difference;
															}?>
                                            	 
                                             <hr>
                                             	<center>
                                                <?php if($s_status=="0"):?>
                                                    <div class="btn-group">
                                                        <a class="btn btn-blue" onclick="confirm_activate('<?php echo base_url();?>manager/requests/swap_approve/<?php echo $swap_id;?>');"><i class="fa fa-check"></i> Approve</a>
                                                    </div>
                                                    <div class="btn-group">
                                                        <a class="btn btn-red"  onclick="confirm_deactivate('<?php echo base_url();?>manager/requests/swap_decline/<?php echo $swap_id;?>');"><i class="fa fa-times"></i> Decline</a>
                                                    </div>
                                                    <?php endif?>
                                                    <?php if($s_status=="1"):?>>
                                                    <div class="btn-group">
                                                        <a class="btn btn-red"  onclick="confirm_deactivate('<?php echo base_url();?>manager/requests/swap_decline/<?php echo $swap_id;?>');"><i class="fa fa-times"></i> Decline</a>
                                                    </div>
                                                    <?php endif?>
                                                    <?php if($s_status=="3"):?>
                                                    <div class="btn-group">
                                                        <a class="btn btn-blue" onclick="confirm_activate('<?php echo base_url();?>manager/requests/swap_approve/<?php echo $swap_id;?>');"><i class="fa fa-check"></i> Approve</a>
                                                    </div>
                                                    <?php endif?>
                                                 </center>
                                                        <hr>
                                                        <h4>Quick Links</h4>
                                                            <ul class="nav nav-pills nav-stacked">
                                                                <li><a href="<?php echo base_url().'manager/time_off' ?>"><i class="fa fa-angle-double-right"></i> Time Off</a>
                                                                </li>
                                                                <li><a href="<?php echo base_url().'manager/schedule_swap' ?>"><i class="fa fa-angle-double-right"></i> Schedule Swap</a>
                                                                </li>
                                                            </ul>
                                            </div>
                                        </div>
                                        
                                        
                                        
                              </div>
                          </div>
                      </div>
                  </div>
