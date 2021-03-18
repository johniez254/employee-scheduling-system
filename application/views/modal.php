<?php 

$id		 =	$this->session->userdata('id');
$role       =	$this->db->get_where('login' , array('id'=>$id))->row()->role; 
?>

<script>	
	function showAjaxModal(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
		//jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');
		
		// LOADING THE AJAX MODAL
		
		jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
		
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				jQuery('#modal_ajax .modal-body').html(response);	

			}
		});
	}
	</script>
	<!-- (Ajax Modal)-->
    <div class="modal fade" id="modal_ajax">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header" style="background-color:#34495e; color:white;">
                    <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;"><i class="fa fa-edit"></i> Edit Details</h4>
                </div>
                
                <div class="modal-body" style="height:470px; overflow:auto;">
                
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    
    <script>
	function showAjaxModalSmall(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
		//jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');
		
		// LOADING THE AJAX MODAL
		
		jQuery('#modal_ajax_small').modal('show', {backdrop: 'true'});
		
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				jQuery('#modal_ajax_small .modal-body').html(response);
				
				//Time Picker Initialization and Custom Functions
					$(document).ready(function() {
						$('#u_from').timepicker();
					
						setTimeout(function() {
							$('#timeDisplay').text($('#u_from').val());
						}, 100);
					
						$('#u_from').on('changeTime.timepicker', function(e) {
							$('#timeDisplay').text(e.time.value);
						});
					});
					
					//Time Picker Initialization and Custom Functions
					$(document).ready(function() {
						$('#u_to').timepicker();
					
						setTimeout(function() {
							$('#timeDisplay').text($('#u_to').val());
						}, 100);
					
						$('#u_to').on('changeTime.timepicker', function(e) {
							$('#timeDisplay').text(e.time.value);
						});
					});
				
				// show datepicker
				$('#sandbox-container input').datepicker({
    autoclose: true,
    todayHighlight: true
		});
		

			}
		});
	}
	
	</script>
    
     <!-- (Ajax small Modal)-->
    <div class="modal fade" id="modal_ajax_small">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header" style="background-color:#34495e; color:white;">
                    <button type="button" class="close" style="color:white;" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center; overflow:auto;"><i class="fa fa-edit"></i> Edit Details</h4>
                </div>
                
                <div class="modal-body" style="">
                
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
     <script>
//responsible for all delete functions
	
	function confirm_modal(delete_url)
	{
		jQuery('#flexModal').modal('show', {backdrop: 'static'});
		document.getElementById('delete_link').setAttribute('href' , delete_url);
		
         $(this).parents(".odd").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
	}
	
	</script>
    
        <!-- (Normal Modal)-->
          <div class="modal modal-flex fade" id="flexModal" tabindex="-1" role="dialog" aria-labelledby="flexModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-red" id="delete_link">delete</a>
                    <button type="button" class="btn btn-green" data-dismiss="modal">cancel</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
		function printDiv(printer){
			//var divToPrint=document.getElementById('printer');
//			var popUpWindow=window.open('','_blank','width=auto,height=auto');
//			popUpWindow.document.open();
//			popUpWindow.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML+'</html>');
//			popUpWindow.document.close();
			var printContents=document.getElementById(printer).innerHTML;
			var originalContents=document.body.innerHTML;
			document.body.innerHTML=printContents;
			window.print() ;
			document.body.innerHTML=printContents;
		}
	
	</script>

<?php if ($role=="manager"){?>
 <script>
//responsible for all delete functions
	
	function confirm_activate(account_url)
	{
		jQuery('#flexModalact').modal('show', {backdrop: 'static'});
		document.getElementById('act_link').setAttribute('href' , account_url);
		
         $(this).parents(".odd").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
	}
	
	</script>
    
        <!-- (Normal Modal)-->
          <div class="modal modal-flex fade" id="flexModalact" tabindex="-1" role="dialog" aria-labelledby="flexModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are You sure you want to approve?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-blue" id="act_link">Approve</a>
                    <button type="button" class="btn btn-green" data-dismiss="modal">cancel</button>
                </div>
            </div>
        </div>
    </div>
    
       <script>
//responsible for all delete functions
	
	function confirm_deactivate(account_url)
	{
		jQuery('#flexModaldact').modal('show', {backdrop: 'static'});
		document.getElementById('dact_link').setAttribute('href' , account_url);
		
         $(this).parents(".odd").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
	}
	
	</script>
    
        <!-- (Normal Modal)-->
          <div class="modal modal-flex fade" id="flexModaldact" tabindex="-1" role="dialog" aria-labelledby="flexModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are You sure you want to Decline?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-red" id="dact_link">Decline</a>
                    <button type="button" class="btn btn-green" data-dismiss="modal">cancel</button>
                </div>
            </div>
        </div>
    </div>
	
	</script>
<?php }?>