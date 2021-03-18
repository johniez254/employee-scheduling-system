<?php
echo doctype('html5');
$system_name       =	$this->db->get_where('settings' , array('id'=>'1'))->row()->systemname;
?>
<head>
	<meta charset="utf-8">
	<title>Register</title>
<?php include'includes_top.php';?>    

</head>
<body class="login">

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="login-banner text-center">
                    <h1><i class="fa fa-gears"></i> <?php echo $system_name; ?></h1>
                </div>
                <div class="portlet portlet-green">
                    <div class="portlet-heading login-heading">
                        <div class="portlet-title"><?PHP //$system_title       =	$this->db->get_where('settings' , array('id'=>'1'))->row()->systemtitle; ?>
                            <h4><strong>Register as New Employee</strong>
                            </h4>
                        </div>
                        <div class="clearfix"></div>

                    </div>
                    <div class="portlet-body">
                    
                    <div class="row">
                    	<div class="col-lg-12">
                        	<div id="rmessage"></div>
                        </div>
                    </div>
                    
                	<?php $attributes = array("name" => "form", 'id'=>'registerForm');
            echo form_open("login/validate_register", $attributes);?>
                    
        <div class="row">
                    
                    <div class="col-lg-6">
                                <label>Full Names:</label>
                                <div class="form-group">
                                <?php
                                        $data=array(
                                            'name'=> 'fullnames',
                                            'type'=>'text',
                                            'id'=>'fullnames',
                                            'placeholder'=>'Full Names',
                                            'autofocus'=>'autofocus',
                                            'autocomplete'=>'off',
                                            'class'=>'form-control',
                                            );
                                            echo form_input($data);
								 ?>
                                </div>
                                <label>Username: <a href="#" data-placement="right" data-toggle="tooltip"  title="Will be used by user to login!"><i class="fa fa-info-circle fa-fw text-blue"></i></a></label>
                                <div class="form-group">
                                <?php
                                        $data=array(
                                            'name'=> 'r_username',
                                            'type'=>'text',
                                            'id'=>'r_username',
                                            'placeholder'=>'username',
                                            'autofocus'=>'autofocus',
                                            'autocomplete'=>'off',
                                            'class'=>'form-control',
                                            );
                                            echo form_input($data);
								 ?>
                                </div>
                               <label>Email:</label>
                                <div class="form-group">
                                    <?php
									$data=array(
										'name'=> 'email',
										'type'=>'text',
										'placeholder'=>'email',
										'autocomplete'=>'off',
										'class'=>'form-control',
										'id'=>'email'
										);
										echo form_input($data);
								 ?>
                                 
                                </div>
                               <label>ID Number:</label>
                                <div class="form-group">
                                    <?php
									$data=array(
										'name'=> 'idno',
										'type'=>'text',
										'placeholder'=>'ID Number',
										'autocomplete'=>'off',
										'class'=>'form-control',
										'id'=>'idno'
										);
										echo form_input($data);
								 ?>
                                </div>
                            
                           </div>
                           <div class="col-lg-6">
                               <label>Phone Number:</label>
                                <div class="form-group">
                                    <?php
									$data=array(
										'name'=> 'phone',
										'type'=>'text',
										'placeholder'=>'Phone Number',
										'autocomplete'=>'off',
										'class'=>'form-control',
										'id'=>'phone'
										);
										echo form_input($data);
								 ?>
                                 
                                </div>
                               <label>Address:</label>
                                <div class="form-group">
                                    <?php
									$data=array(
										'name'=> 'address',
										'type'=>'text',
										'placeholder'=>'address',
										'autocomplete'=>'off',
										'class'=>'form-control',
										'id'=>'address'
										);
										echo form_input($data);
								 ?>
                                 
                                </div>
                               <label>Password:</label>
                                <div class="form-group">
                                    <?php
									$data=array(
										'name'=> 'r_password',
										'type'=>'password',
										'placeholder'=>'password',
										'autocomplete'=>'off',
										'class'=>'form-control',
										'id'=>'r_password'
										);
										echo form_input($data);
								 ?>
                                 
                                </div>
                               <label>Confirm Password:</label>
                                <div class="form-group">
                                    <?php
									$data=array(
										'name'=> 'cpassword',
										'type'=>'password',
										'placeholder'=>'Confirm password',
										'autocomplete'=>'off',
										'class'=>'form-control',
										'id'=>'cpassword'
										);
										echo form_input($data);
								 ?>
                                 
                                 <input type="hidden" name="d" value="<?php echo date('Ymd')?>"/>
                                 
                                </div>
                           </div>
                                
                             
                             
                      </div>
                           
                           <div class="row">
                           	<div class="col-lg-12"> 
							<?php 
                                $data=array(
                                    'type'=> 'submit',
                                    'value'=>'Register',
                                    'class'=>'btn btn-lg btn-green btn-block',
                                    );
                                    echo form_submit($data);
								
								 ?>
                                 
                        <?php echo form_close(); ?>
                        <br>
                            <span class="small" style="float:right;">
                                Already having an account? <a href="<?php echo base_url() ?>" class="btn btn-orange btn-xs">Login</a>
                            </span>
                            </div>
                           </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php include'includes_bottom.php';?>
</body>
</html>