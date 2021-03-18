<?php foreach($station_id->result() as $row):
$id=$row->station_id;
$station=$row->station_name;
//$status=$row->status;


?>

                                 <?php endforeach;?>
					 <?php $attributes = array("name" => "form", 'enctype' => 'multipart/form-data', 'id'=>'updateStationForm');
            echo form_open("manager/stations_crud/update/".$id, $attributes);?>
            									<div id="stationUpdateMessage"></div>
                                                <div class="form-group">
                                                    <label>Station Name</label>
                                                    <input type="text" class="form-control" value="<?php echo $station; ?>" name="s" placeholder="Station Name" id="s">
                                                </div>
                                                <button type="submit" id="btnSave" class="btn btn-green">Update Station</button>
                                                <button type="reset" class="btn btn-orange"> <i class="fa fa-eraser"></i> Reset</button>
                                            <?php echo form_close();?>
	<script src="<?php echo base_url(); ?>components/custom_js/stations.js"></script>