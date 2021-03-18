<?php
$id		 =	$this->session->userdata('id');
$role       =	$this->db->get_where('login' , array('id'=>$id))->row()->role; 

$username       =	$this->db->get_where('login' , array('id'=>$id))->row()->username;
?>
<?php if($role=='manager'){ ?>
     <!-- Logout Notification Box -->
    <div id="logout">
        <div class="logout-message">
            <img class="img-circle img-logout" src="<?php echo $this->crud->get_image_url('user',$id);?>" alt="" width="150px" height="150px">
            <h3>
                <i class="fa fa-sign-out text-green"></i> Ready to Go?
            </h3>
            <p>Select "Logout" below if you are ready<br />to end your current session.</p>
            <ul class="list-inline">
                <li>
                    <a href='<?php echo base_url()?>manager/logout' class="btn btn-green">
                        <strong>Logout</strong>
                    </a>
                </li>
                <li>
                    <button class="logout_close btn btn-green">Cancel</button>
                </li>
            </ul>
        </div>
    </div>
    <!-- /#logout -->
    <!-- Logout Notification jQuery -->
    
    
    <?php }elseif ($role=='user'){?>
	<!-- Logout Notification Box -->
    <div id="logout">
        <div class="logout-message">
            <img class="img-circle img-logout" src="<?php echo $this->crud->get_image_url('user',$id);?>" alt="" width="150px" height="150px">
            <h3>
                <i class="fa fa-sign-out text-green"></i> Ready to go?
            </h3>
            <p>Select "Logout" below if you are ready<br> to end your current session.</p>
            <ul class="list-inline">
                <li>
                    <a href='<?php echo base_url()?>user/logout' class="btn btn-green">
                        <strong>Logout</strong>
                    </a>
                </li>
                <li>
                    <button class="logout_close btn btn-green">Cancel</button>
                </li>
            </ul>
        </div>
    </div>
    <!-- /#logout -->
    <!-- Logout Notification jQuery -->
    
    
    <?php }