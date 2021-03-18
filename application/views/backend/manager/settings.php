
								
                                 <div class="row">                    
                    
                     <div class="col-lg-8">
                     <div class="row">
                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                     <h4><i class="fa fa-gears"></i> Settings</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <ul id="myTab" class="list-inline tabbed-portlets">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#purplePortlet"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="purplePortlet" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div id="myTabContent" class="tab-content">
                                        <div class="tab-pane fade in active" id="general">
                                            <h4>
                                            	<strong><i class="fa fa-list"></i> General<hr /></strong>
                                            </h4> <div class="row">
                                        <div class="col-lg-12">
                                     
									 <?php $setting_id=$this->db->get_where('settings', array('id' => 1)); ?>
									 
									    <?php foreach($setting_id->result() as $row):
$id=$row->id;
$sname=$row->systemname;
$abbr=$row->abbr;
$address=$row->address;
$em=$row->email;
$phone=$row->phone;
//$cur=$row->currency;


?>

                                 <?php endforeach;?>
                                 
                                        <?php $attributes = array("name" => "form", 'id' => 'settingsForm');
            echo form_open("manager/validate_setting", $attributes);?>
            <div id="settingMessage"></div>
                                                           <div class="form-group">
                                                          
                                                                <label>System Name :</label>
                 <?php 
								$data=array(
								'name'=> 'sname',
								'type'=>'text',
								'placeholder'=>'system name',
								'class'=>'form-control',
								'id'=>'sname',
								'value'=>$sname,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                          
                                                                <label>System Abbreviation :</label>
                 <?php 
								$data=array(
								'name'=> 'abr',
								'type'=>'text',
								'placeholder'=>'abbreviation',
								'class'=>'form-control',
								'id'=>'abr',
								'value'=>$abbr,
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
                                                          
                                 <label>Email :</label>
                 <?php 
								$data=array(
								'name'=> 'email',
								'type'=>'text',
								'placeholder'=>'email',
								'class'=>'form-control',
								'id'=>'email',
								'value'=>$em,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                      
                                                            </div>
                                                            
                                                            
                                 <div class="form-group">
                                   <label>Phone number :</label>
                 <?php 
								$data=array(
								'name'=> 'phone',
								'type'=>'number',
								'placeholder'=>'phone number',
								'class'=>'form-control',
								'id'=>'phone',
								'value'=>$phone,
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
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
								'value'=>'Reset',
								
								);
								echo form_reset($data);
								?>
                                                            
                   <?php echo form_close()?>

                                            
                                        </div>
                                    </div>
                                        </div>
                                        <div class="tab-pane fade" id="language">
                                            <h4>
                                            	<strong><i class="fa fa-rocket"></i> Language Setting<hr /></strong>
                                            </h4>
                                            


                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- /.col-lg-8-->

                    
                    
                    

                    <div class="col-lg-4">

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="portlet portlet-green">
                                    <div class="portlet-heading">
                                        <div class="portlet-title">
                                            <h4><i class="fa fa-picture-o"></i> Upload</h4>
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
                                        
                                        <h4>Current :</h4>
                                        <div class="tile light-gray">

                    <a href="#">
                        <img class="img-responsive" src="<?php echo $this->crud->get_image_url('logo','logo');?>"  alt="logo image" width="172px" height="20px">
                    </a>
                                        </div>
                                        
                                        <?php $at = array("name" => "form","encytype"=>"multipart/form-data");
            echo form_open_multipart(base_url() .'manager/update_logo', $at);?>
                                                            <div class="form-group">
                                                                <label>Chose New Logo</label>
                              
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
                        
                        
                     <div class="row">

                            <div class="col-lg-12">
                                <div class="portlet portlet-green">
                                    <div class="portlet-heading">
                                        <div class="portlet-title">
                                            <h4><i class="fa fa-shield"></i> Data Manager</h4>
                                        </div>
                                        <div class="portlet-widgets">
                                            <span class="divider"></span>
                                            <a data-toggle="collapse" data-parent="#accordion" href="#headingsPortlet2"><i class="fa fa-chevron-down"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="headingsPortlet2" class="panel-collapse collapse in">
                                        <div class="portlet-body">
                                         
                                         	<!--<div class="btn-group btn-group-justified">
                                        <a class="btn btn-blue" role="button"><i class="fa fa-folder"></i> Backup</a>
                                        <a class="btn btn-red" role="button"><i class="fa fa-mail-reply-all"></i> Restore</a>
                                    </div>
                                    -->
                                    
                                    <div class="panel-group" id="accordion">
                                            <div class="panel panel-green">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="text-decoration:none;">
                                                        <p class="panel-title"><button class="btn btn-blue btn-block"><i class="fa fa-download"></i> Backup</button></p>
                                                    </a>
                                                <div id="collapseOne" class="panel-collapse collapse" style="border-left:1px solid #2980b9; border-bottom:1px solid #2980b9; border-right:1px solid #2980b9;">
                                                    <div class="panel-body">
                                                        <!--back up data-->
                                                        <center>
                                                        
                                                        <table cellpadding="0" cellspacing="0" border="0" class="table table-condensed" >

                    <tbody>
                                                        
                                                        
                    	<?php 

						for($i = 1; $i<= 11; $i++):

						

							if($i	==	1)	$type	=	'all';

							else if($i	==	2)$type	=	'family';
							else if($i	==	3)$type	=	'login';
							else if($i	==	4)$type	=	'schedules';
							else if($i	==	5)$type	=	'settings';
							else if($i	==	6)$type	=	'shifts';
							else if($i	==	7)$type	=	'station';
							else if($i	==	8)$type	=	'swap';
							else if($i	==	9)$type	=	'time_off';
							else if($i	==	10)$type	=	'time_off_options';
							else if($i	==	11)$type	=	'users';

							?>

							<tr>

								<td><?php echo $type;?></td>

								<td align="center">

									<a href="<?php echo base_url();?>manager/data_manager/create/<?php echo $type;?>" 

										class="btn btn-blue btn-xs" data-toggle="tooltip" title="download backup"><i class="fa fa-download" ></i>

											</a>

								</td>

							</tr>

							<?php 

						endfor;

						?>

                    </tbody>

                </table>

                </center>

                                                        
                                                        <!--end backuu data-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-green">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="text-decoration:none;">
                                                        <p class="panel-title"><button class="btn btn-orange btn-block"><i class="fa fa-mail-reply-all"></i> Restore</button></p>
                                                    </a>
                                                <div id="collapseTwo" class="panel-collapse collapse" style="border-left:1px solid #f39c12; border-bottom:1px solid #f39c12; border-right:1px solid #f39c12;">
                                                    <div class="panel-body">
                                                        <?php echo form_open('manager/settings/restore' , array('enctype' => 'multipart/form-data'));?>

                   <div class="form-group">
                                                    <input type="file" name="userfile" id="exampleInputFile">
                                                    <p class="help-block">Restore.</p>
                                                </div>
                                                
                                                <button type="submit" class="btn btn-orange btn-block">Restore</button>

                <?php echo form_close();?>
                                                    </div>
                                                </div>
                                            </div>
                                         </div>


                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-lg-12 (nested) -->


                        </div>
                        <!-- /.row (nested) -->
                                        

                    </div>
                    <!-- /.col-lg-4 -->                                     
                                    
                    
                </div>
                <!-- /.row -->
