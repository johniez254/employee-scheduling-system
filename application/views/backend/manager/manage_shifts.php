 <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Manage Shifts</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab">Available Shifts</a>
                                    </li>
                                    <li><a href="#profile" data-toggle="tab">Add Shift</a>
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
                                        
                                          <!-- Striped Responsive Table -->
                                                        <div class="table-responsive">
                                                        <div id="printer">
                                                            <table class="table table-bordered table-striped table-green" id="example-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Shift Name</th>
                                                                        <th>From - To</th>
                                                                        <th>Duration</th>
                                                                        <th>Station</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
																	<?php
                                                                        //$where="due>='1'";
                                                                        $this->db->select('*');
                                                                        $this->db->from('shifts');
                                                                        //$this->db->where($where);
                                                                        $this->db->order_by('start_time','asc');
                                                                        $this->db->join('station', 'station.station_id = shifts.station_id');
                                                                        $desc	=	$this->db->get()->result_array();
                                                                        $i='1';
                                                                        foreach($desc as $row):
                                                                        $id=$row['shift_id'];
                                                                        $sn=$row['shift_name'];
                                                                        $st=$row['start_time'];
                                                                        $et=$row['end_time'];
                                                                        $sname=$row['station_name'];
																		$hw=$row['hours_worked'];
                                                                        ?>
                                                                    <tr>
                                                                        <td><?php echo $i++ ?></td>
                                                                        <td><?php echo $sn?></td>
                                                                        <td>
                                                                        	<?php //date_default_timezone_set('Africa/Nairobi');?>
																			<?php echo date("h:i a",$st)?> - <?php echo date("h:i a",$et)?>
                                                                        </td>
                                                                        <td>
																			<?php echo $hw. ' hours'; ?>
                                                                        </td>
                                                                        <td><?php echo $sname?></td>
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown">Action
                                                                                    <span class="caret"></span>
                                                                                </button>
                                                                                <ul class="dropdown-menu" role="menu" style="text-align:left; widows:20px;">
                                                                                    <?php /*?><li><a href="<?php echo base_url();?>manager/shifts/view/<?php echo urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($id))))))))?>;"><small><i class="fa fa-book"></i> View</small></a>
                                                                                    </li><?php */?>
                                                                                    <li><a href="#" onclick="showAjaxModalSmall('<?php echo base_url();?>manager/shifts/edit/<?php echo $id;?>');"><small><i class="fa fa-edit "></i> Edit</small></a>
                                                                                    </li>
                                                                                    <li><a href="#" onclick="confirm_modal('<?php echo base_url();?>manager/shifts/delete/<?php echo $id;?>');"><small><i class="fa fa-trash-o"></i> Delete</small></a>
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
                                    
                                   <?php /*?> <?php
									$maza=date('m/d/Y');
									$str_maza=strtotime($maza);
									
									//$str_date=date("d/m/Y",$s_start_date);	
									//$previous_day=strtotime("-1 days",strtotime($str_date));
									
									$maza1=strtotime("+1 days",strtotime($maza));
									
									$str_maza1=date("d/m/Y",$maza1);
									echo $maza1;
									
									$mrn="10:00 pm";
									$tm="6:00 am";
									//echo $tm;
									
									$str_mrn=strtotime($mrn);
									$str_tm=strtotime($tm);
									
									//get pm/am
									$mrn_pm_am=date('a',$str_mrn);
									$now_pm_am=date('a',$str_tm);
									
									if($mrn_pm_am=="am" && $now_pm_am=='am'){
										$start=new DateTime($mrn);
										$end=new DateTime($tm);
										$interval=$start->diff($end);
										
										//get output
										$output=$interval->format('%h');
											echo $output;
										}
									if($mrn_pm_am=="am" && $now_pm_am=='pm'){
										$start=new DateTime($mrn);
										$end=new DateTime($tm);
										$interval=$start->diff($end);
										
										//get output
										$output=$interval->format('%h');
											echo $output;
									}
									if($mrn_pm_am=="pm" && $now_pm_am=='pm'){
										$start=new DateTime($mrn);
										$end=new DateTime($tm);
										$interval=$start->diff($end);
										
										//get output
										$output=$interval->format('%h');
											echo $output;
									}
									if($mrn_pm_am=="pm" && $now_pm_am=='am'){
										$start=new DateTime($maza. $mrn);
										$end=new DateTime($str_maza1. $tm);
										$interval=$start->diff($end);
										
										//get output
										$output=$interval->format('%h');
											echo $output;
									}
									//echo $mrn_pm_am;
									?>                    <?php */?>              
                                        
                                         <?php $at = array("name" => "form","id"=>"addShiftForm");
            echo form_open_multipart(base_url() .'manager/shifts/add', $at);?>
            												<div id="addShiftMessage"></div>
                                                            <h4 class="page-header">Add Shift Details</h4>
                                                            <div class="form-group">
                                                                <label>Select Station</label>
                                                                <select name="station" id="station" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Station"  >
																  <?php 
                                                                    $s = $this->db->get('station')->result_array();
                                                                    foreach($s as $row):
                                                                  ?>
                                                                    <option value="<?php echo $row['station_id'];?>">
                                                                        <?php echo $row['station_name'];?>
                                                                    </option>
                                                                	<?php
                                                                	endforeach;
                                                              		?>
                                                                </select>

                                                            </div>
                                                            <div class="form-group">
                                                                <label>Select Shift Name</label>
                                                                <select name="shift" id="shift" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Shift Name"  >
                                                                    <option value="MORNING">MORNING</option>
                                                                    <option value="EVENING">EVENING</option>
                                                                    <option value="NIGHT">NIGHT</option>
                                                                </select>

                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <label>From:</label>
                                                                    <div class="input-append bootstrap-timepicker input-group">
                                                                        <input id="from" class="form-control" type="text"  name="from"/>
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-default add-on" type="button"><i class="fa fa-clock-o"></i>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-lg-6">
                                                                    <label>To:</label>
                                                                    <div class="input-append bootstrap-timepicker input-group">
                                                                        <input id="to" class="form-control" type="text" name="to"  onkeyup="GetHours()" onclick="GetHours()"/>
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-default add-on" type="button"><i class="fa fa-clock-o"></i>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <h4 class="page-header"></h4>
                                                            
                                                            <button type="submit" class="btn btn-green">Add Shift</button>
                                                            <button class="btn btn-orange" type="reset">Cancel</button>
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
//function GetHours() {
//var from = Number($("#from").val());
//var to = Number($("#to").val());
//var hours = to - from;
//$("#total_hours").val(hours);
//}
//
//document.getElementById("from").value;
//document.querySelector("#from").value;
//document.querySelector("#to").addEventListener("change",GetHours);
</script>	