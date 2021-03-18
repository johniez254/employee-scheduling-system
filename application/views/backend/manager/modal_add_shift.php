 <?php foreach($station_id->result() as $row):
$station_name=$row->station_name;
$station_id=$row->station_id;
 endforeach;
 ?>
<?php $at = array("name" => "form","id"=>"addShiftForm");
            echo form_open_multipart(base_url() .'manager/shifts/add', $at);?>
            												<div id="addShiftMessage"></div>
                                                            <h4 class="page-header">Add Shift Details</h4>
                                                            <div class="form-group">
                                                                <label>Station</label>
                                                                <input type="text" readonly value="<?php echo $station_name;?>" class="form-control">
                                                                <input type="hidden" name="station" id="station" value="<?php echo $station_id?>">

                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <!--<label>Shift Name</label>
                                                                <input type="text" autocomplete="off" class="form-control" name="shift" id="shift" placeholder="shift name">
                                                            </div>-->
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
                                                                <div class="col-lg-12">
                                                                <br>
                                                                <button type="submit" class="btn btn-green">Add Shift</button>
                                                                </div>
                                                        </form>
                                                            </div>
	<script src="<?php echo base_url(); ?>components/custom_js/shifts.js"></script>