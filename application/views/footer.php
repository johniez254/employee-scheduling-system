<?php $system_name       =	$this->db->get_where('settings' , array('id'=>'1'))->row()->systemname;?>
<div class="row">
	<div class="col-lg-12">
		<p class="text-center">
        	<b>Copyright &copy; <?php echo date('Y'); ?> | <?php echo $system_name; ?> | Developed by : <b class="text-info">Johnson</b></b>
		</p>
	</div>
</div>                                        

