 <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Time Offs Management</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab">Time Off Requests</a>
                                    </li>
                                    <li><a href="#profile" data-toggle="tab">Absence Options</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="home">
                                    
                                    	<hr />
                                       <p class="text-right"><a onclick="showAjaxModal('<?php echo base_url();?>manager/time_crud/add')" class="btn btn-sm btn-blue text-left">Add Time Off</a></p>
                                       <hr />
                                       
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
                                        	//$where="employee_id=".$id."";
											$this->db->select('*');
											$this->db->from('time_off');
											//$this->db->where($where);
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
											$today_date=date('m/d/Y');
											$when_to_start=date("m/d/Y",$start_from);
											$start=new DateTime($today_date);
											$end=new DateTime($when_to_start);
											$interval=$start->diff($end);
											//$days_difference=$interval->format('%d');
											$r_difference=$interval->format('%R');
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
                                                                                    <?php if($approval_status=='0'){ ?>
                                                                                    <?php if($r_difference=="+"){?>
                                                                                    <li><a href="#" onclick="confirm_activate('<?php echo base_url();?>manager/requests/approve/<?php echo $time_off_id;?>');"><small><i class="fa fa-check "></i> Approve</small></a>
                                                                                    <li><a href="#" onclick="confirm_deactivate('<?php echo base_url();?>manager/requests/decline/<?php echo $time_off_id;?>');"><small><i class="fa fa-times "></i> Decline</small></a>
                                                                                    </li>
                                                                                    <?php }}?>
                                                                                    <?php if($approval_status=='2'){ ?>
                                                                                    <?php if($r_difference=="+"){?>
                                                                                    <li><a href="#" onclick="confirm_deactivate('<?php echo base_url();?>manager/requests/decline/<?php echo $time_off_id;?>');"><small><i class="fa fa-times "></i> Decline</small></a>
                                                                                    </li>
                                                                                    <?php }}?>
                                                                                    <?php if($approval_status=='3'){ ?>
                                                                                    <?php if($r_difference=="+"){?>
                                                                                    <li><a href="#" onclick="confirm_activate('<?php echo base_url();?>manager/requests/approve/<?php echo $time_off_id;?>');"><small><i class="fa fa-times "></i> Approve</small></a>
                                                                                    </li>
                                                                                    <?php }}?>
                                                                                    <li><a href="<?php echo base_url();?>manager/requests/view_time_off/<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($time_off_id))))))))?>;"><small><i class="fa fa-book"></i> View</small></a>
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
                                    
                                    	<hr />
                                       <p class="text-right"><a onclick="showAjaxModalSmall('<?php echo base_url();?>manager/option_crud/add')" class="btn btn-sm btn-blue text-left">Add Time Off Option</a></p>
                                       <hr />
                                        
                                        
                                        <div class="table-responsive">
                                                	
                                    <table id="damaged-stock" class="table table-striped table-bordered table-hover table-green">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th>Option Code</th>
                                                <th>Option Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        	$where="option_id!='0'";
											$this->db->select('*');
											$this->db->from('time_off_options');
											$this->db->where($where);
											//$this->db->order_by('time_off_id','desc');
											//$this->db->join('users', 'users.id = time_off.employee_id');
											//$this->db->join('time_off_options', 'time_off_options.option_id = time_off.reason');
											//$this->db->join('station', 'station.station_id = schedules.station_id');
											$_option	=	$this->db->get()->result_array();
											$c='1';
											foreach($_option as $row):
											$_option_id=$row['option_id'];
											$_option_code=$row['option_code'];
											$_option_name=$row['option_name'];
											?>
                                        <tr class="odd gradeX">
                                            	<td><?php echo $c++; ?></td>
                                                <td><?php echo $_option_code ?></td>
                                                <td><?php echo $_option_name; ?></td>
                                                
                                                <td class="center">
                                                
                                              <div class="btn-group">
                                        <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown">Action
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" onclick="showAjaxModalSmall('<?php echo base_url();?>manager/option_crud/edit/<?php echo $_option_id;?>');"><small><i class="fa fa-edit"></i> Edit</small></a>
                                            </li>
                                            <li><a href="#" onclick="confirm_modal('<?php echo base_url();?>manager/option_crud/delete/<?php echo $_option_id;?>');"><small><i class="fa fa-trash-o"></i> Delete</small></a>
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
                            </div>
                            <!-- /.portlet-body -->
                        </div>
                        <!-- /.portlet -->

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->