  <?php
$user_id= $this->session->userdata('id');
$id=$this->db->get_where('users' , array('login_id'=>$user_id))->row()->id;

$ol="employee_id=".$id."";
$this->db->select('*');
$this->db->from('time_off');
$this->db->where($ol);
$count_time_off	=	$this->db->count_all_results();

?>
  <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Time Off Requests</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab">Time Off</a>
                                    </li>
                                    <li><a href="#profile" data-toggle="tab">Add Time Off</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="home">
                                    
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
                                                <th>Employee</th>
                                                <th>Time off Duration</th>
                                                <th>Reason</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        	$where="employee_id=".$id."";
											$this->db->select('*');
											$this->db->from('time_off');
											$this->db->where($where);
											$this->db->order_by('time_off_id','desc');
											$this->db->join('users', 'users.id = time_off.employee_id');
											$this->db->join('time_off_options', 'time_off_options.option_id = time_off.time_off_options_id');
											//$this->db->join('station', 'station.station_id = schedules.station_id');
											$desc	=	$this->db->get()->result_array();
											$i='1';
											foreach($desc as $row):
											$time_off_id=$row['time_off_id'];
											$employee_name=$row['fullnames'];
											$employee_id=$row['employee_id'];
											$start_from=$row['start_from'];
											$end_time=$row['end_time'];
											$reason=$row['reason'];
											$option_name=$row['option_name'];
											$approval_status=$row['request_status'];
											$time_off_options_id=$row['time_off_options_id'];
											//$option_name       =	$this->db->get_where('time_off_options' , array('option_id'=>$time_off_options_id))->row()->option_name;
											?>
                                        <tr class="odd gradeX">
                                            	<td><?php echo $i++; ?></td>
                                                <td><?php echo $employee_name; ?></td>
                                                <td><?php echo date('m/d/Y',$start_from)."&nbsp;-&nbsp;". date('m/d/Y',$end_time).""?></td>
                                                <td>
												<?php if($time_off_options_id=='0'){ echo $reason;} ?>
                                                <?php if($time_off_options_id!='0'){ echo $option_name;} ?>
                                                </td>
                                                <td>
												<?php if($approval_status=='0'){ echo '<span class="label orange"><i class="fa fa-clock-o"></i> Pending</span>'; }?>
                                                <?php if($approval_status=='1'){ echo '<span class="label label-default"><i class="fa fa-arrow-circle-right"></i> Finished</span>'; }?>
												<?php if($approval_status=='2'){ echo '<span class="label green"><i class="fa fa-check-circle-o"></i> Approved</span>'; }?>
                                                <?php if($approval_status=='3'){ echo '<span class="label red"><i class="fa fa-times-circle-o"></i> Declined</span>'; }?>
                                                </td>
                                                <td>
                                                                            <div class="btn-group">
                                                                                <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown">Action
                                                                                    <span class="caret"></span>
                                                                                </button>
                                                                                <ul class="dropdown-menu" role="menu" style="text-align:left; widows:20px;">
                                                                                <?php if($approval_status=='0'){?>
                                                                                    <li><a href="#" onclick="showAjaxModalSmall('<?php echo base_url();?>user/requests/edit/<?php echo $time_off_id;?>');"><small><i class="fa fa-edit "></i> Edit</small></a>
                                                                                    </li>
                                                                                <?php }?>
                                                                                    <li><a href="<?php echo base_url();?>user/requests/view_time_off/<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($time_off_id))))))))?>;"><small><i class="fa fa-book"></i> View</small></a>
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
                                    <?php if( $count_time_off=="0"){?>
                                    <?php $at = array("name" => "form","id"=>"addTimeOffForm");
            echo form_open_multipart(base_url() .'user/requests/add', $at);?>
                                                            <h4 class="page-header">Add Time-Off Details</h4>
            												<div id="addTimeOffMessage"></div>
                                                            <div class="form-group">
                                                                <label>Select Time Off Reason:</label>
                                                                <select name="reason" id="reason" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Time Off Reason"  onchange="return  get_option(this.value)">
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
                                                            <input type="hidden" name="employee_id" value="<?php echo $id; ?>" />
                                                            <div id="option_display"></div>
                                                            
                                                            <!-- Default Daterange Picker -->
                                                            <div class='form-group bootstrap-timepicker'>
                                                                <label>Select Time-Off Duration:</label>
                                                                <input type='text' class="form-control daterange" id="date_range" name="date_range" autocomplete="off"/>
                                                            </div>
                                                            <input type="hidden" name="d_requested" id="d_requested" value="<?php echo date('m/d/Y'); ?>" />
                                                            
                                                            <h4 class="page-header"></h4>
                                                            
                                                            <button type="submit" class="btn btn-green">Submit</button>
                                                            <button class="btn btn-orange" type="reset">Reset Fields</button>
                                                        </form>
                                    <?php }?>
                                    
                                        <?php
                                        	$where="employee_id=".$id."";
											$this->db->select('*');
											$this->db->from('time_off');
											$this->db->where($where);
											$d	=	$this->db->get()->result_array();
											foreach($d as $row):
											$time_off_id=$row['time_off_id'];
											$check_timeoff_status=$row['time_off_status'];
											$start_from=$row['start_from'];
											$end_time=$row['end_time'];
											$approval_status=$row['request_status'];
											if($check_timeoff_status=='1'){?>
                                        <?php $at = array("name" => "form","id"=>"addTimeOffForm");
            echo form_open_multipart(base_url() .'user/requests/add', $at);?>
                                                            <h4 class="page-header">Add Time-Off Details</h4>
            												<div id="addTimeOffMessage"></div>
                                                            <div class="form-group">
                                                                <label>Select Time Off Reason:</label>
                                                                <select name="reason" id="reason" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Time Off Reason"  onchange="return  get_option(this.value)">
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
                                                            <input type="hidden" name="employee_id" value="<?php echo $id; ?>" />
                                                            <div id="option_display"></div>
                                                            
                                                            <!-- Default Daterange Picker -->
                                                            <div class='form-group bootstrap-timepicker'>
                                                                <label>Select Time-Off Duration:</label>
                                                                <input type='text' class="form-control daterange" id="date_range" name="date_range" autocomplete="off"/>
                                                            <input type="hidden" name="d_requested" id="d_requested" value="<?php echo date('m/d/Y'); ?>" />
                                                            </div>
                                                            
                                                            <h4 class="page-header"></h4>
                                                            
                                                            <button type="submit" class="btn btn-green">Submit</button>
                                                            <button class="btn btn-orange" type="reset">Reset Fields</button>
                                                        </form>
                                                        
                                            <?php }else{ ?>
                                            <hr />
                                            <h4>You already have an active Time off starting from <strong><?= date("m/d/Y",$start_from)?></strong> to <strong><?= date("m/d/Y",$end_time)?></strong></h4>
                                            <h4>Approval Status: <?php if($approval_status=='0'){ echo '<span class="label orange"><i class="fa fa-clock-o"></i> Waiting for Approval</span>'; }?>
                                                <?php if($approval_status=='1'){ echo '<span class="label label-default"><i class="fa fa-arrow-circle-right"></i> Finished</span>'; }?>
												<?php if($approval_status=='2'){ echo '<span class="label green"><i class="fa fa-check-circle-o"></i> Approved</span>'; }?>
                                                <?php if($approval_status=='3'){ echo '<span class="label red"><i class="fa fa-times-circle-o"></i> Declined</span>'; }?> </h4>
                                                <hr />
                                                <a class="btn btn-blue" href="<?php echo base_url();?>user/requests/view_time_off/<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($time_off_id))))))))?>;"><i class="fa fa-arrow-circle-right"></i> View More</a>
                                            <?php 
											}
											endforeach;
											?>
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
	//get shift
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