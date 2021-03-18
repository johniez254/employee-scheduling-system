<?php foreach($s_id->result() as $row):
$swap_id=$row->swap_id;
$schedule_id=$row->schedule_id;
$employee_from=$row->employee_from;
$employee_to=$row->employee_to;
$s_start_date=$row->s_start_date;
$s_end_date=$row->s_end_date;
$time_off_options_id=$row->time_off_options_id;
$reason=$row->reason;
$s_status=$row->s_status;
endforeach;
?>
<blockquote><h3>Edit Swap</h3></blockquote>

<?php $at = array("name" => "form","id"=>"updateSwapForm");
            echo form_open_multipart(base_url() .'manager/requests/swap_update/'.$swap_id, $at);?>
            												<div id="updateSwapMessage"></div>
                                                            
                                                            <div class="form-group">
                                                            	<label>Employee To Swap from:</label>
                                                                 <select name="read" id="read"class="form-control" disabled="disabled"  >
																  <?php 
																  $where="id=".$employee_from."";
																	$this->db->select('*');
																	$this->db->from('users');
																	$this->db->where($where);
																	$emp	=	$this->db->get()->result_array();
                                                                    foreach($emp as $row):
                                                                  ?>
                                                                    <option value="<?php echo $row['id'];?>" <?php if($employee_to==$row['id']){echo "selected";}?>>
                                                                        <?php echo $row['fullnames'];?>
                                                                    </option>
                                                                	<?php
                                                                	endforeach;
                                                              		?>
                                                                </select>
                                                            
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label>Select Employee to swap to</label>
                                                                <select name="u_employee" id="u_employee" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Employee to swap to"  >
																  <?php 
																  $where="id!=".$employee_from."";
																	$this->db->select('*');
																	$this->db->from('users');
																	$this->db->where($where);
																	$emp	=	$this->db->get()->result_array();
                                                                    foreach($emp as $row):
                                                                  ?>
                                                                    <option value="<?php echo $row['id'];?>" <?php if($employee_to==$row['id']){echo "selected";}?>>
                                                                        <?php echo $row['fullnames'];?>
                                                                    </option>
                                                                	<?php
                                                                	endforeach;
                                                              		?>
                                                                </select>
                                        </div>
                                                            <?php if($time_off_options_id!="0"){?>
                                                            <div class="form-group">
                                                                <label>Select Time Off Reason:</label>
                                                                <select name="u_reason" id="u_reason" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Time Off Reason"  onchange="return  get_option(this.value)">
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
                                                                <select name="u_reason" id="u_reason" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Time Off Reason"  onchange="return  get_option(this.value)">
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
                                                            
                                                            <div id="option_display2"></div>
                                                            
                                                            
                                                            <input type="hidden" name="employee_id" value="<?php echo $employee_from; ?>" />
                                                            <input type="hidden" name="schedule_id" value="<?php echo $schedule_id; ?>" />
                                                            
                                                            <div class="form-group">
                                                            	<label>Start Date:</label>
                                                                <div id="sandbox-container">
                                                                    <input type="text" id="u_start_date" name="u_start_date" value="<?php echo date('m/d/Y',$s_start_date); ?>" placeholder="mm/dd/yyyy" class="form-control">
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                            <button type="submit" class="btn btn-green">Update</button>
                                                            <button class="btn btn-orange" type="reset">Reset Fields</button>
                                                        </form>
<script src="<?php echo base_url(); ?>components/custom_js/swap.js"></script>
<script>
	//get option
	function get_option(id) {

    	$.ajax({
            url: '<?php echo base_url();?>manager/requests/get_option/' + id ,
            success: function(response)
            {
				$('#option_display1').remove();
                jQuery('#option_display2').html(response);
            }
        });

    }
	</script>