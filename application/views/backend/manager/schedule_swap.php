<?php
$user_id= $this->session->userdata('id');

?>
 <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Swap Management</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-refresh"></i>  Swaps</a>
                                    </li>
                                    <li><a href="#profile" data-toggle="tab"><i class="fa fa-plus"></i> Add Swap</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="home">
                                    <?php 
									//$tday_date=date('m/d/Y');
									//$td=strtotime($tday_date);
									//echo $td;
									//$e=strtotime("-1 days",strtotime($tday_date));
									//$e=date("d/m/Y",$e);
									//echo $e;
									
									?>
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
                                                <th>Swap</th>
                                                <th>Station/Shift</th>
                                                <th>Duration</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        	//$where="employee_from=".$id." AND s_status='0'";
											$this->db->select('*');
											$this->db->from('swap');
											//$this->db->where($where);
											//$this->db->order_by('schedule_id','desc');
											$this->db->join('users', 'users.id = swap.employee_to');
											$this->db->join('schedules', 'schedules.schedule_id = swap.schedule_id');
											$this->db->join('station', 'station.station_id = schedules.station_id');
											$this->db->join('shifts', 'shifts.shift_id = schedules.shift_id');
											$desc	=	$this->db->get()->result_array();
											$i='1';
											foreach($desc as $row):
											$swap_id=$row['swap_id'];
											$schedule_id=$row['schedule_id'];
											$employee_name=$row['fullnames'];
											$shift_name=$row['shift_name'];
											$start_time=$row['start_time'];
											$end_time=$row['end_time'];
											$duration_from=$row['s_start_date'];
											$duration_to=$row['s_end_date'];
											$station_name=$row['station_name'];
											$schedule_status=$row['schedule_status'];
											$swap_status=$row['s_status'];
											$employee_from=$row['employee_from'];
											$employee_swapping       =	$this->db->get_where('users' , array('id'=>$employee_from))->row()->fullnames;
											?>
                                        <tr class="odd gradeX">
                                            	<td><?php echo $i++; ?></td>
                                                <td style="min-width:150px;">
                                                	<p><strong>FROM: </strong><?php echo $employee_swapping; ?></p>
                                                	<p><strong>TO: </strong><?php echo $employee_name; ?></p>
                                                </td>
                                                <td>STATION: <p class="label blue"><?php echo $station_name; ?></p><br />
                                                &nbsp&nbsp&nbsp&nbsp&nbsp
												SHIFT: <p class="label blue"><?php echo $shift_name.'&nbsp;('.date("h:i a",$start_time)."&nbsp;-&nbsp;".date("h:i a",$end_time).")"?></p></td>
                                                <td><?php echo date("m/d/Y",$duration_from); ?> - <?php echo date("m/d/Y",$duration_to); ?></td>
                                                <td>
												<?php if($swap_status=='0'){ echo '<span class="label orange">Pending</span>'; }?>
                                                <?php if($swap_status=='1'){ echo '<span class="label green">Approved</span>'; }?>
                                                <?php if($swap_status=='3'){ echo '<span class="label red">Declined</span>'; }?>
                                                <?php if($swap_status=='4'){ echo '<span class="label label-default">Finished</span>'; }?>
                                                </td>
                                                <td>
                                                	 
                                                                            <div class="btn-group">
                                                                                <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown">Action
                                                                                    <span class="caret"></span>
                                                                                </button>
                                                                                <ul class="dropdown-menu" role="menu" style="text-align:left; widows:20px;">
                                                                                <?php if($swap_status=='0'){?>
                                                                                    <li><a href="#" onclick="showAjaxModalSmall('<?php echo base_url();?>manager/requests/swap_edit/<?php echo $swap_id;?>');"><small><i class="fa fa-edit "></i> Edit</small></a>
                                                                                    </li>
                                                                                    <li><a href="#"  onclick="confirm_activate('<?php echo base_url();?>manager/requests/swap_approve/<?php echo $swap_id;?>');"><small><i class="fa fa-check "></i> Approve</small></a>
                                                                                    </li>
                                                                                    <li><a href="#"  onclick="confirm_deactivate('<?php echo base_url();?>manager/requests/swap_decline/<?php echo $swap_id;?>');"><small><i class="fa fa-times "></i> Decline</small></a>
                                                                                    </li>
                                                                                    
                                                                                <?php }?>
                                                                                
                                                                                    <li><a href="<?php echo base_url();?>manager/requests/view_swap/<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($swap_id))))))))?>;"><small><i class="fa fa-book"></i> View more</small></a>
                                                                                    </li>
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
                                    <div class="tab-pane fade" id="profile">
                                    
                                    <?php $at = array("name" => "form","id"=>"addSwapForm");
            echo form_open_multipart(base_url() .'manager/requests/swap_add', $at);?>
                                                            <h4 class="page-header">Add Swap Details</h4>
            												<div id="addSwapMessage"></div>
                                        <div class="form-group">
                                        	<label>Select Employee with current shift</label>
                                            <select name="employee_c" id="employee_c" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Employee with current shift"  onchange="return  get_duration(this.value)">
																  <?php 
																  $where="schedule_status='0'";
																	$this->db->select('*');
																	$this->db->from('schedules');
																	$this->db->where($where);
																	$this->db->join('users', 'users.id = schedules.employee_id');
																	$this->db->join('station', 'station.station_id = schedules.station_id');
																	$this->db->join('shifts', 'shifts.shift_id = schedules.shift_id');
																	$emp	=	$this->db->get()->result_array();
                                                                    foreach($emp as $row):
                                                                  ?>
                                                                    <option value="<?php echo $row['id'];?>">
                                                                        <?php echo $row['fullnames'];?> - <?php echo $row['station_name'];?> (<?php echo $row['shift_name'];?>:<?php echo date("h:i a",$row['start_time']);?>-<?php echo date("h:i a",$row['end_time']);?>)
                                                                    </option>
                                                                	<?php
                                                                	endforeach;
                                                              		?>
                                                                </select>
                                        </div>
                                        
                                        <div id="display_duration"></div>
                                        
                                        <div class="form-group">
                                        	<label>Select Employee to swap to</label>
                                            <select name="employee" id="employee" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Employee to swap to"  >
																  <?php 
																  //$where="id!=".$id."";
																	$this->db->select('*');
																	$this->db->from('users');
																	//$this->db->where($where);
																	$emp	=	$this->db->get()->result_array();
                                                                    foreach($emp as $row):
                                                                  ?>
                                                                    <option value="<?php echo $row['id'];?>">
                                                                        <?php echo $row['fullnames'];?>
                                                                    </option>
                                                                	<?php
                                                                	endforeach;
                                                              		?>
                                                                </select>
                                        </div>
                                        
                                                            <div class="form-group">
                                                                <label>Select Swap Reason:</label>
                                                                <select name="reason" id="reason" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Swap Reason:"  onchange="return  get_option(this.value)">
																  <?php 
																	$where="option_id!=0";
																	$this->db->select('*');
																	$this->db->from('time_off_options');
																	$this->db->where($where);
																	$this->db->order_by('option_name','asc');
																	$s	=	$this->db->get()->result_array();
                                                                    foreach($s as $row):
                                                                  ?>
                                                                    <option value="<?php echo $row['option_id'];?>">
                                                                        <?php echo $row['option_name'];?>
                                                                    </option>
                                                                	<?php
                                                                	endforeach;
                                                              		?>
                                                                    <option value="other">Other Reason</option>
                                                                </select>

                                                            </div>
                                                            <input type="hidden" id="date_requested" name="date_requested" value="<?php echo date('m/d/Y'); ?>" />
                                                            <div id="option_display"></div>
                                                            
                                                            <div class="form-group">
                                                            	<label>Start Date:</label>
                                                                <div id="sandbox-container">
                                                                    <input type="text" id="start_date" name="start_date" value="<?php echo date('m'.'/'.'d'.'/'.'Y'); ?>" placeholder="mm/dd/yyyy" class="form-control">
                                                                </div>
                                                            </div>
                                                            
                                                            <h4 class="page-header"></h4>
                                                            
                                                            <button type="submit" class="btn btn-green">Submit</button>
                                   </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.portlet-body -->
                        </div>
                        <!-- /.portlet -->

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
    
	<script>
	//get shift duration for selected employee
	function get_duration(id) {

    	$.ajax({
            url: '<?php echo base_url()?>manager/requests/get_duration/' + id ,
            success: function(response)
            {
				$('.help-block').remove();
							
                jQuery('#display_duration').html(response);
            }
        });

    }
	
	//get option
	function get_option(id) {

    	$.ajax({
            url: '<?php echo base_url()?>user/requests/get_option/' + id ,
            success: function(response)
            {
                jQuery('#option_display').html(response);
            }
        });

    }
	</script>