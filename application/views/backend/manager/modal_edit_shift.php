<?php foreach($id->result() as $row):
$id=$row->shift_id;
$shift_name=$row->shift_name;
$st=$row->start_time;
$et=$row->end_time;
$s_id=$row->station_id;


?>

                                 <?php endforeach;?>
				<blockquote><h3>Edit Shift</h3></blockquote>
					 <?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data', 'id'=>'updateShiftForm');
            echo form_open("manager/shifts/update/".$id, $attributes);?>
            									<div id="shiftUpdateMessage"></div>
                                                <?php /*?><div class="form-group">
                                                    <label>Shift Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $shift_name; ?>" name="u_shift" placeholder="Shift Name" id="u_shift">
                                                </div><?php */?>
                                                			
                                                            <div class="form-group">
                                                                <label>Select Shift Name</label>
                                                                <select name="u_shift" id="u_shift" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Shift Name"  >
                                                                    <option value="MORNING" <?php if($shift_name == 'MORNING'){echo "selected";}?>>MORNING</option>
                                                                    <option value="EVENING" <?php if($shift_name == 'EVENING'){echo "selected";}?>>EVENING</option>
                                                                    <option value="NIGHT" <?php if($shift_name == 'NIGHT'){echo "selected";}?>>NIGHT</option>
                                                                </select>

                                                            </div>
                                                            <div class="form-group">
                                                                <label>Select Station</label>
                                                                <select name="u_station" id="u_station" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Station"  >
																  <?php 
                                                                    $s = $this->db->get('station')->result_array();
                                                                    foreach($s as $row):
                                                                  ?>
                                                                    <option value="<?php echo $row['station_id'];?>" <?php if($s_id == $row['station_id']){echo "selected";}?>>
                                                                        <?php echo $row['station_name'];?>
                                                                    </option>
                                                                	<?php
                                                                	endforeach;
                                                              		?>
                                                                </select>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <label>From:</label>
                                                                    <div class="input-append bootstrap-timepicker input-group">
                                                                        <input id="u_from" class="form-control" value="<?php echo date("h:i a",$st);?>" type="text"  name="u_from"/>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-lg-6">
                                                                    <label>To:</label>
                                                                    <div class="input-append bootstrap-timepicker input-group">
                                                                        <input id="u_to" class="form-control" value="<?php echo date("h:i a",$et);?>" type="text" name="u_to" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br />
                                                <button type="submit" id="btnSave" class="btn btn-green">Update Shift</button>
                                                <button type="reset" class="btn btn-orange"> <i class="fa fa-eraser"></i> Reset</button>
                                            <?php echo form_close();?>
	<script src="<?php echo base_url(); ?>components/custom_js/shifts.js"></script>