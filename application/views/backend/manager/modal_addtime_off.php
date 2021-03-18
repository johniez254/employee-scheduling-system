
				<blockquote><h3>Add Employee Time Off</h3></blockquote>
<?php $at = array("name" => "form","id"=>"addTimeOffForm");
            echo form_open_multipart(base_url() .'manager/time_crud/add_time_off', $at);?>
            												<div id="addTimeOffMessage"></div>
                                                            <div class="form-group">
                                                                <label>Select Employee:</label>
                                                                <select name="employee_id" id="employee_id" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Employee" >
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
                                                            <div id="option_display"></div>
                                                            
                                                            <!-- Default Daterange Picker -->
                                                            <div class='form-group bootstrap-timepicker'>
                                                                <label>Select Time-Off Duration:</label>
                                                                <input type='text' class="form-control daterange" id="date_range" name="date_range" autocomplete="off"/>
                                                            </div>
                                                            <input type="hidden" name="d_requested"  value="<?php echo date('m/d/Y');?>"/>
                                                            
                                                            <button type="submit" class="btn btn-green">Submit</button>
                                                            <button class="btn btn-orange" type="reset">Reset Fields</button>
                                                        </form>
                                                        
<script src="<?php echo base_url()?>components/custom_js/time_off.js"></script>                                                        
<script>
	//get shift
	function get_option(id) {

    	$.ajax({
            url: '<?php echo base_url()?>manager/requests/get_option/' + id ,
            success: function(response)
            {
                jQuery('#option_display').html(response);
            }
        });

    }
	</script>