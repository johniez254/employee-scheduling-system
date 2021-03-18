<?php
echo doctype('html5');
$system_name      =	$this->db->get_where('settings' , array('id'=>'1'))->row()->systemname;
?>
<head>
	<meta charset="utf-8">
	<title>Login page</title>
<?php include'includes_top.php';?> 

</head>
<body class="login">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-banner text-center">
                    <h1><i class="fa fa-gears"></i> <?php echo $system_name; ?></h1>
                </div>
                <div class="portlet portlet-green">
                    <div class="portlet-heading login-heading">
                        <div class="portlet-title"><?PHP $abbr       =	$this->db->get_where('settings' , array('id'=>'1'))->row()->abbr; ?>
                            <h4><strong>Login to <?php echo $abbr;?> !</strong>
                            </h4>
                        </div>
                        <div class="clearfix"></div>

                    </div>
                    <div class="portlet-body">
                	<?php $attributes = array("name" => "form", 'id'=>'loginForm');
            echo form_open("login/validate", $attributes);?>
            					<div id="message"></div>
                                <label>Username:</label>
                                <div class="form-group">
                                <?php
                                        $data=array(
                                            'name'=> 'username',
                                            'type'=>'text',
                                            'id'=>'username',
                                            'placeholder'=>'username',
                                            'autofocus'=>'autofocus',
                                            'autocomplete'=>'off',
                                            'class'=>'form-control',
                                            );
                                            echo form_input($data);
								 ?>
                                </div>
                               <label>Password:</label>
                                <div class="form-group">
                                    <?php
									$data=array(
										'name'=> 'password',
										'type'=>'password',
										'placeholder'=>'password',
										'autocomplete'=>'off',
										'class'=>'form-control',
										'id'=>'password'
										);
										echo form_input($data);
								 ?>
                                 
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <br>
                              <?php 
                                $data=array(
                                    'type'=> 'submit',
                                    'value'=>'Log In',
                                    'class'=>'btn btn-lg btn-green btn-block login-button',
									//'disabled'=>'disabled'
                                    );
                                    echo form_submit($data);
								
								 ?>
                            <br>
                        <?php echo form_close(); ?>
                            <span class="small text-left">
                                <a href="<?php echo base_url() ?>login/forgot_password/forgot">Forgot Password?</a>
                            </span>
                            <span class="small" style="float:right;">
                                New user? <a href="register" class="btn btn-orange btn-xs">Register</a>
                            </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>  
<?php include'includes_bottom.php';?>
</body>
</html>