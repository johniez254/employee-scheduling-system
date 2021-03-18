<?php foreach($option_id->result() as $row):
$option_id=$row->option_id;
$option_code=$row->option_code;
$option_name=$row->option_name;
endforeach;
?>
<blockquote><h3>Update Time Off Option</h3></blockquote>

 <?php $at = array("name" => "form", "id"=>"updateOptionForm");
            echo form_open_multipart(base_url() .'manager/option_crud/update_option/'.$option_id, $at);?>
    
    <div id="updateOptionMessage"></div>
    
    <div class="form-group">
        <label>Option Code:</label>
        <input type="text" name="option_code" id="option_code" class="form-control" value="<?php echo $option_code?>"/>
    </div>
    
    <div class="form-group">
        <label>Option Name:</label>
        <input type="text" name="option_name" id="option_name" class="form-control" value="<?php echo $option_name?>"/>
    </div>
    
    <button class="btn btn-green" type="submit">Update</button>

</form>
	<script src="<?php echo base_url(); ?>components/custom_js/time_off.js"></script>