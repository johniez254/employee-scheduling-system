 <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Manage Shift Schedules</h4>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="portlet-body">
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab">Schedules</a>
                                    </li>
                                    <li><a href="#profile" data-toggle="tab">Add New Schedule</a>
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
                                                <th>Station/Shift</th>
                                                <th>Employee</th>
                                                <th>Duration</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        //$where="due>='1'";
											$this->db->select('*');
											$this->db->from('schedules');
											//$this->db->where($where);
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
                                                                                   <?php if($schedule_status=='0'){ ?>
                                                                                    <li><a href="#" onclick="showAjaxModalSmall('<?php echo base_url();?>manager/schedules_crud/edit/<?php echo $schedule_id;?>');"><small><i class="fa fa-edit "></i> Edit</small></a>
                                                                                    </li>
                                                                                    <?php } ?>
                                                                                    <li><a href="#" onclick="confirm_modal('<?php echo base_url();?>manager/schedules_crud/delete/<?php echo $schedule_id;?>');"><small><i class="fa fa-trash-o"></i> Delete</small></a>
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
                                        <div id="scheduleAddMessage"></div>
                                        
                                       
                                        
                                        <?php $at = array("name" => "form","id"=>"addScheduleForm");
            echo form_open_multipart(base_url() .'manager/schedules_crud/add', $at);?>
                                        	<div class="form-group">
                                            	<label>Select Employee:</label>
                                                <select name="employee" id="employee" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Employee" >
																  <?php 
                                                                    $station = $this->db->get('users')->result_array();
                                                                    foreach($station as $row):
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
                                            	<label>Select Station:</label>
                                            	<select name="station" id="station" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Station" onchange="return select_shift(this.value)">
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
                                            	<label>Select Shift:</label>
                                            	<select name="shift" id="shift" class="form-control">
                                                    <option value="">Select Station First</option>
                                                </select>
                                            </div>
                                            
                                            
                                            
                                            <!-- Default Daterange Picker -->
                                            <div class='form-group bootstrap-timepicker'>
                                            	<label>Select Duration</label>
                                                <input type='text' class="form-control daterange" id="date_range" name="date_range" autocomplete="off"/>
                                            </div>
                                            <input type="hidden" name="date_scheduled" value="<?php echo date('m/d/Y')?>" />
                                            
                                            <button type="submit" class="btn btn-green">Add Schedule</button>
                                            <button class="btn btn-orange" type="reset">Reset</button>
                                            
                                            
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
	//get shift
	function select_shift(id) {

    	$.ajax({
            url: '<?php echo base_url()?>manager/schedules_crud/get_shift/' + id ,
            success: function(response)
            {
                jQuery('#shift').html(response);
            }
        });

    }
	</script>