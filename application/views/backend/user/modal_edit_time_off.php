<?php foreach($timeoff_id->result() as $row):
$time_off_id=$row->time_off_id;
$start_from=$row->start_from;
$end_time=$row->end_time;
$employee_id=$row->employee_id;
$time_off_options_id=$row->time_off_options_id;
$reason=$row->reason;
endforeach;
?>
<blockquote><h3>Edit Time Off Option</h3></blockquote>

<?php $at = array("name" => "form","id"=>"updateTimeOffForm");
            echo form_open_multipart(base_url() .'user/requests/update/'.$time_off_id, $at);?>
            												<div id="updateTimeOffMessage"></div>
                                                            <?php if($time_off_options_id!="0"){?>
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
                                                                    <option value="<?php echo $row['option_id'];?>" <?php if($time_off_options_id==$row['option_id']){echo "selected";}?>>
                                                                        <?php echo $row['option_name'];?>
                                                                    </option>
                                                                	<?php
                                                                	endforeach;
                                                              		?>
                                                                    <option value="other">Other Reason</option>
                                                                </select>

                                                            </div>
                                                            <?php }else{?>
                                                            <div class="form-group">
                                                                <label>Select Time Off Reason:</label>
                                                                <select name="reason" id="reason" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Time Off Reason"  onchange="return  get_option(this.value)">
                                                                    <option value="other">Other Reason</option>
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
                                                                </select>

                                                            </div>
                                                            
                                                           <div id="option_display1"> 
                                                            <div id="form-group">
                                                            	<label>Add Other Reason for Time Off:</label>
						 										<textarea class="form-control" name="other_reason" required="required" id="other_reason" placeholder="Input the reason..."><?php echo $reason; ?>
                                                                </textarea>
                                                           </div>
                                                           </div><br />
                                                            
                                                            <?php }?>
                                                            
                                                            <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>" />
                                                            <div id="option_display"></div>
                                                            
                                                            <!-- Default Daterange Picker -->
                                                            <div class='form-group bootstrap-timepicker'>
                                                                <label>Select Time-Off Duration:</label>
                                                                <input type='text' class="form-control daterange" id="date_range" name="date_range" autocomplete="off" value="<?php echo date('m/d/Y',$start_from) ?> - <?php echo date('m/d/Y',$end_time) ?>"/>
                                                            </div>
                                                            
                                                            <h4 class="page-header"></h4>
                                                            
                                                            <button type="submit" class="btn btn-green">Update</button>
                                                            <button class="btn btn-orange" type="reset">Reset Fields</button>
                                                        </form>
		 <script>
	//get shift
	function get_option(id) {

    	$.ajax({
            url: '<?php echo base_url()?>user/requests/get_option/' + id ,
            success: function(response)
            {
				$('#option_display1').remove();
                jQuery('#option_display').html(response);
            }
        });

    }
	</script>
	<script src="<?php echo base_url(); ?>components/custom_js/time_off.js"></script>