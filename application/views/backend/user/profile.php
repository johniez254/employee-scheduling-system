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
                                    <h4>User profile</h4>
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
                                    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-bars"></i> Profile Details</a>
                                    </li>
                                    <li><a href="#family" data-toggle="tab"><i class="fa fa-users"></i> Family Details</a>
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
										$role=$row->role;
										$em=$row->username;
									endforeach;?>
                                    <?php $profile_id=$this->db->get_where('users', array('login_id' => $id)); ?>
									 
									    <?php foreach($profile_id->result() as $row):
										$fn=$row->fullnames;
										$email=$row->email;
										$phone=$row->phone;
										$address=$row->address;
										$idno=$row->idno;
									endforeach;?>
                                 
                                        <?php $attributes = array("name" => "form", 'id'=>'nameForm');
            echo form_open("user/validate_profile", $attributes);?> 
            
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
								'value'=>$fn,
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
                                                          
                                                                <label>Phone :</label>
                 <?php 
								$data=array(
								'name'=> 'phone',
								'type'=>'text',
								'placeholder'=>'phone',
								'class'=>'form-control',
								'id'=>'phone',
								'value'=>$phone,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>                                         
                                                           
                                                            <div class="form-group">
                                                          
                                                                <label>Address :</label>
                 <?php 
								$data=array(
								'name'=> 'address',
								'type'=>'text',
								'placeholder'=>'address',
								'class'=>'form-control',
								'id'=>'address',
								'value'=>$address,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>                                       
                                                           
                                                            <div class="form-group">
                                                          
                                                                <label>IDNO :</label>
                 <?php 
								$data=array(
								'name'=> 'idno',
								'type'=>'text',
								'placeholder'=>'idno',
								'class'=>'form-control',
								'id'=>'idno',
								'value'=>$idno,
								'readonly'=>'readonly'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            <div class="form-group">
                                                          
                                                                <label>Email :</label>
                 <?php 
								$data=array(
								'name'=> 'email',
								'type'=>'text',
								'placeholder'=>'email',
								'class'=>'form-control',
								'id'=>'email',
								'value'=>$email,
								'readonly'=>'readonly'
								
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
                                    
                                    
                                    <div class="tab-pane fade" id="family">
                                    
                                    	<?php
                                            $where="login_id=".$id."";
                                            $this->db->select('*');
                                            $this->db->from('family');
                                            $this->db->where($where);
                                            $count=$this->db->count_all_results();
										?>
                                        <?php if($count=="0"){?>
            
                                         <div id="familyMessage"></div>
                                        
                                         <?php $attributes = array("name" => "form", 'id' => 'familyForm');
            echo form_open("user/family/add", $attributes);?>
                                         
                                         <div class="form-group">
                                         	<label>Select Marital Status:</label>
                                            <select name="marital_status" id="marital_status" data-style="btn btn-white btn-square" class="selectpicker form-control" data-live-search="true" title="Select Status" onchange="return  get_family(this.value)">
                                            <option value="0">Single</option>
                                            <option value="1">Married</option>
                                            </select>
                                         </div>
                                         
                                         <div id="family_display"></div>
                                         
                                         <button type="submit" class="btn btn-green">Submit</button>
                                         
                                         <?php echo form_close();?> 
                                        
                                        <?php }else{?>
                                        	<div class="form-group">
                                            <?php
                                                $where="login_id='".$id."'";
                                                $this->db->select('*');
                                                $this->db->from('family');
                                                $this->db->where($where);
                                                $desc	=	$this->db->get()->result_array();
												foreach($desc as $row):
												 $family_id=$row['family_id'];
												 $spouse_name=$row['spouse_name'];
												 $marital_status=$row['marital_status'];
												 $spouse_phone=$row['spouse_phone'];
												 $kids=$row['kids'];
												endforeach
											?>
            
                                         <div id="familyMessage"></div>
                                        
                                         <?php $attributes = array("name" => "form", 'id' => 'familyForm');
            echo form_open("user/family/update", $attributes);?>
                                         
                                         <div class="form-group">
                                         	<label>Marital Status:</label>
                                            <select name="u_marital_status"<?php if($marital_status=="1"){echo"disabled='true'";}?> id="u_marital_status" data-style="btn btn-white btn-square btn-disabled" class="selectpicker form-control" data-live-search="true" title="Select Status">
                                            <option value="0" <?php if($marital_status=="0"){echo"selected";}?>>Single</option>
                                            <option value="1" <?php if($marital_status=="1"){echo"selected";}?>>Married</option>
                                            </select>
                                         </div>
                                                    <label>Spouse Name:</label>
                                                    <input type="text" name="spouse" value="<?php echo $spouse_name;?>" placeholder="spouse name" id="spouse" class="form-control">
                                                 </div>
                                                  <div class="form-group">
                                                    <label>Spouse Phone Number:</label>
                                                    <input type="text" name="s_phone" value="<?php echo $spouse_phone;?>" id="s_phone" placeholder="spouse phone number" class="form-control">
                                                  </div>
                                                  <div class="form-group">
                                                    <label>Number Of Kids:</label>
                                                    <input type="text" name="kids" id="kids" value="<?php echo $kids;?>" placeholder="number of kids" class="form-control">
                                                    <?php if($marital_status=="1"){?>
                                                    <input type="hidden" name="u_marital_status" value="<?php echo $marital_status;?>" id="u_marital_status" />
                                                    <?php }?>
                                              </div>
                                         
                                         <button type="submit" class="btn btn-green">Update</button>
                                         <button type="reset" class="btn btn-orange">Reset</button>
                                         <?php echo form_close()?>
                                        <?php }?>           
                                    </div>
                                    
                                    <div class="tab-pane fade" id="profile">
                                        
                                        
                                        <!--password-->
                                        
                                         <?php $attributes = array("name" => "form", 'id' => 'passwordForm');
            echo form_open("user/validate_password", $attributes);?>
            
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
            echo form_open_multipart(base_url() .'user/update_image', $at);?>
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
<script>
	//get shift
	function get_family(id) {

    	$.ajax({
            url: '<?php echo base_url()?>user/family/get_family/' + id ,
            success: function(response)
            {
                jQuery('#family_display').html(response);
            }
        });

    }
	</script>