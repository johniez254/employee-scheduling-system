
<blockquote><h3>Add Time Off Option</h3></blockquote>

 <?php $at = array("name" => "form", "id"=>"addOptionForm");
            echo form_open_multipart(base_url() .'manager/option_crud/add_option', $at);?>
    
    <div id="addOptionMessage"></div>
    
    <div class="form-group">
        <label>Option Code:</label>
        <input type="text" name="option_code" id="option_code" class="form-control" />
    </div>
    
    <div class="form-group">
        <label>Option Name:</label>
        <input type="text" name="option_name" id="option_name" class="form-control" />
    </div>
    
    <button class="btn btn-green" type="submit">Save</button>

</form>
	<script src="<?php echo base_url(); ?>components/custom_js/time_off.js"></script>