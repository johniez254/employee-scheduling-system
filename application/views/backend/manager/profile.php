 <?php
            $username=$this->session->userdata('username');
			$id		 =	$this->session->userdata('id');           
            
            ?>
			
             <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-8">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>manager profile</h4>
                                </div>
                                <div class="portlet-widgets">
                                            <span class="divider"></span>
                                            <a href="javascript:;"><i class="fa fa-refresh"></i></a>
                                            <span class="divider"></span>
                                            <a data-toggle="collapse" data-parent="#accordion" href="#headingsPortlet1"><i class="fa fa-chevron-down"></i></a>
                                        </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="headingsPortlet1" class="panel-collapse collapse in">
                            <div class="portlet-body">
                            
                            	<div class="row">
                                <div class="col-lg-12">
                                 
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-bars"></i> Manage Profile</a>
                                    </li>
                                    <li><a href="#profile" data-toggle="tab"><i class="fa fa-unlock-alt"></i> Change Password</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="home">
                                        
                                        <!--manage profile-->
                                        
                                         <?php $setting_id=$this->db->get_where('login', array('id' => $id)); ?>
									 
									    <?php foreach($setting_id->result() as $row):
$id=$row->id;
$pass=$row->password;
$names=$row->name;
$role=$row->role;
$em=$row->username;


?>

                                 <?php endforeach;?>
                                 
                                        <?php $attributes = array("name" => "form", 'id'=>'nameForm');
            echo form_open("manager/validate_profile", $attributes);?> 
            
            												<div id="nameMessage"></div>
                                                            <div class="form-group">
                                                          
                                                                <label>Name :</label>
                 <?php 
								$data=array(
								'name'=> 'name',
								'type'=>'text',
								'placeholder'=>'name',
								'class'=>'form-control',
								'id'=>'name',
								'value'=>$names,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>                                       
                                                           
                                                            <div class="form-group">
                                                          
                                                                <label>Username :</label>
                 <?php 
								$data=array(
								'name'=> 'username',
								'type'=>'text',
								'placeholder'=>'username',
								'class'=>'form-control',
								'id'=>'username',
								'value'=>$em,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            
                                                                 <div class="form-group">
                                                          
                                                                <label>Role :</label>
                 <?php 
								$data=array(
								'name'=> 'role',
								'type'=>'text',
								'placeholder'=>'role',
								'class'=>'form-control',
								'id'=>'role',
								'value'=>$role,
								'readonly'=>'readonly'
								
								);
								echo form_input($data);
								echo form_error('role');
															
								 ?>
                                      
                                                            </div>
                                                            
                                                            <?php 
								$data=array(
								'type'=>'submit',
								'class'=>'btn btn-green',
								'value'=>'save',
								
								);
								echo form_submit($data);
								?>
                                
                                                       <?php 
								$data=array(
								'type'=>'reset',
								'class'=>'btn btn-orange',
								'value'=>'reset',
								
								);
								echo form_reset($data);
								?>
                                                            
                   <?php echo form_close()?>

                                        
                                         <!--end manage profile-->
                                        
                                        
                                    </div>
                                    
                                    <div class="tab-pane fade" id="profile">
                                        
                                        
                                        <!--password-->
                                        
                                         <?php $attributes = array("name" => "form", 'id' => 'passwordForm');
            echo form_open("manager/validate_password", $attributes);?>
            
                                                            <div id="passwordMessage"></div>
                                                            <div class="form-group">
                                                          
                                                                <label>Current Password :</label>
                 <?php 
								$data=array(
								'name'=> 'oldpass',
								'type'=>'password',
								'placeholder'=>'current password',
								'class'=>'form-control',
								'id'=>'oldpass',
								'value'=>set_value('oldpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                           
                                                            
                                                            <div class="form-group">
                                                          
                                                                <label>New Password :</label>
                 <?php 
								$data=array(
								'name'=> 'newpass',
								'type'=>'password',
								'placeholder'=>'new password',
								'class'=>'form-control',
								'id'=>'newpass',
								'value'=>set_value('newpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                           
                                                            
                                                            <div class="form-group">
                                                          
                                                                <label>Confirm Password :</label>
                 <?php 
								$data=array(
								'name'=> 'confpass',
								'type'=>'password',
								'placeholder'=>'comfirm password',
								'class'=>'form-control',
								'id'=>'confpass',
								'value'=>set_value('confpass'),
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                           
                                                            
                                                              <?php
														   $data=array(
														   'type'=>'hidden',
														   'name'=>'username',
														   'value'=>$em,
														   );
														   echo form_input($data);
														    ?>
                                                            
                                                         
                                                            <?php 
								$data=array(
								'type'=>'submit',
								'class'=>'btn btn-green',
								'value'=>'change password',
								
								);
								echo form_submit($data);
								?>
                                                            
                                                            <?php echo form_close() ?>
                                        
                                        <!--end password-->
                                        
                                    </div>
                                </div>
                                
                                </div></div>
                                <!-- nested col-lg-12 and row -->
                                
                                
                                
                            </div>
                            <!-- /.portlet-body -->
                            </div>
                            <!--collapse-->
                        </div>
                        <!-- /.portlet -->

                    </div>
                    <!-- /.col-lg-12 -->
                
                <!--end manage profile -->
                
                <!--start pass picture tab-->
                
                
                	<div class="col-lg-4">
                    	
                         <div class="row">

                            <div class="col-lg-12">
                                <div class="portlet portlet-green">
                                    <div class="portlet-heading">
                                        <div class="portlet-title">
                                            <h4><i class="fa fa-picture-o"></i> Upload Picture</h4>
                                        </div>
                                        <div class="portlet-widgets">
                                            <span class="divider"></span>
                                            <a href="javascript:;"><i class="fa fa-refresh"></i></a>
                                            <span class="divider"></span>
                                            <a data-toggle="collapse" data-parent="#accordion" href="#headingsPortlet"><i class="fa fa-chevron-down"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="headingsPortlet" class="panel-collapse collapse in">
                                        <div class="portlet-body">
                                        
                                        <h4>Current Profile Picture :</h4>

                    <a href="#">
                        <img class="img-responsive img-profile" src="<?php echo $this->crud->get_image_url('user',$id);?>"  alt="logo picture" width="150px" height="150px">
                    </a>
                                        <?php $at = array("name" => "form","encytype"=>"multipart/form-data");
            echo form_open_multipart(base_url() .'manager/update_image', $at);?>
                                                            <div class="form-group">
                                                                <label>Chose a New Picture</label>
                              
                                                                <?php
                                                                $dat=array(
								'type'=>'file',
								'name'=> 'userfile',
								'accept'=>'image/*',
								'id'=>'userfile',
								'required'=>'required'
								
								);
								echo form_input($dat);
								
								 ?>
                                                                <p class="help-block"><i class="fa fa-warning"></i> Formats (jpg, png, gif, JPG, PNG, GIF)</p>
                              <?php
                                                                $dat=array(
								'type'=>'submit',
								'value'=>'upload',
								'class'=>'btn btn-green btn-block',
								'id'=>'submit'
								
								);
								echo form_input($dat);
								
								 ?>
                                                            </div>
                                                        <?php echo form_close()?>

                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-lg-12 (nested) -->


                        </div>
                        <!-- /.row (nested) -->

                        
                    </div>
                
                <!--end pass picture tab-->
                
                </div>
                <!-- /.full row -->
