<script src="<?php echo base_url(); ?>components/custom_js/schedules.js"></script><?php foreach($schedule_id->result() as $row):
$shift_id=$row->shift_id;
$schedule_id=$row->schedule_id;
$df=$row->duration_from;
$dt=$row->duration_to;
$station_id=$row->station_id;
$employee_id=$row->employee_id;



?>

                                 <?php endforeach;?>
				<blockquote><h3>Edit Schedule</h3></blockquote>
					 <?php $attributes = array("name" => "form", 'id'=>'updateScheduleForm');
            echo form_open("manager/schedules_crud/update/".$schedule_id, $attributes);?>
            									<div id="scheduleUpdateMessage"></div>
                                                <div class="form-group">
                                                    <label>Select Employee</label>
                                                <select name="u_employee" id="u_employee" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Employee" >
																  <?php 
                                                                    $emp = $this->db->get('users')->result_array();
                                                                    foreach($emp as $row):
                                                                  ?>
                                                                     <option value="<?php echo $row['id'];?>" <?php if($employee_id==$row['id']){echo "selected";}?>>
                                                                        <?php echo $row['fullnames'];?>
                                                                    </option>
                                                                	<?php
                                                                	endforeach;
                                                              		?>
                                                                </select>
                                                </div>
                                                            <div class="form-group">
                                                                <label>Select Station</label>
                                                                <select name="u_station" id="u_station" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Station"  onchange="return select_shift(this.value)">
																  <?php 
                                                                    $s = $this->db->get('station')->result_array();
                                                                    foreach($s as $row):
                                                                  ?>
                                                                    <option value="<?php echo $row['station_id'];?>" <?php if($station_id == $row['station_id']){echo "selected";}?>>
                                                                        <?php echo $row['station_name'];?>
                                                                    </option>
                                                                	<?php
                                                                	endforeach;
                                                              		?>
                                                                </select>

                                                            </div>
                                                             <div class="form-group">
                                            	<label>Select Shift:</label>
                                            	<select name="u_shift" id="u_shift" class="form-control">
                                                <?php
                                                    $e = $this->db->get_where('shifts' , array('shift_id' => $shift_id))->result_array();
                                                    foreach ($e as $row) {
                                                        $shift_id=$row['shift_id'];
                                                        $shift_name=$row['shift_name'];
                                                        $start_time=$row['start_time'];
                                                        $end_time=$row['end_time'];
												?>
                                                    <option id="initial" value="<?php echo $shift_id?>"><?php echo $shift_name?> (<?php echo date('h:i a', $start_time)?> - <?php echo date('h:i a', $end_time)?>)</option>
														
                                                    <?php }?>
                                                </select>
                                            </div>
                                            
                                            
                                            
                                            <!-- Default Daterange Picker -->
                                            <div class='form-group bootstrap-timepicker'>
                                            	<label>Select Duration</label>
                                                <input type='text' value="<?php echo date("m/d/Y",$df); ?> - <?php echo date("m/d/Y",$dt); ?>" class="form-control daterange" id="date_range" name="date_range" autocomplete="off"/>
                                            </div>
                                                            <br />
                                                <button type="submit" id="btnSave" class="btn btn-green">Update Schedule</button>
                                                <button type="reset" class="btn btn-orange"> <i class="fa fa-eraser"></i> Reset</button>
                                            <?php echo form_close();?>
<script>
	//get shift
	function select_shift(id) {

    	$.ajax({
            url: '<?php echo base_url()?>manager/schedules_crud/get_shift/' + id ,
            success: function(response)
            {
				$("#initial").remove();
                jQuery('#u_shift').html(response);
            }
        });

    }
</script>