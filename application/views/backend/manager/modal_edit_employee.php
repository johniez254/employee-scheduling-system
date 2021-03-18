<?php foreach($id->result() as $row):
$id=$row->id;
$fn=$row->fullnames;
$email=$row->email;
$phone=$row->phone;
$address=$row->address;
$idno=$row->idno;
$login_id=$row->login_id;
$approval=$row->approval;
$date=$row->date_reg;


?>

                                 <?php endforeach;?>
                                 <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#picture" data-toggle="tab"><i class="fa fa-picture-o"></i> Edit Photo</a>
                                    </li>
                                    <li><a href="#user" data-toggle="tab"><i class="fa fa-user"></i> Edit Employee</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="picture">
                                        
                                        <!--start picture-->
                                        
                                        
                                        <h4>Current Photo :</h4>
                    <a href="#">
                        <img class="img-responsive img-profile" src="<?php echo $this->crud->get_image_url('user',$login_id);?>"  alt="" width="200px" height="200px">
                    </a>
                                        <?php $at = array("name" => "form","encytype"=>"multipart/form-data", "id"=>"updateUserimage");
            echo form_open_multipart(base_url() .'manager/employees_crud/update_image/'.$login_id.'', $at);?>
                                                            <div class="form-group">
                                                                <label>Chose a new picture</label>
                              
                                                                <?php
                                                                $dat=array(
								'type'=>'file',
								'name'=> 'userfile',
								'accept'=>'image/*',
								'id'=>'userfile',
								
								);
								echo form_input($dat);
								
								 ?>
                                                                <p class="help-block"><i class="fa fa-warning"></i> Image Specify</p>
                              <?php
                                                                $dat=array(
								'type'=>'submit',
								'value'=>'Upload',
								'class'=>'btn btn-green',
								'id'=>'submit'
								
								);
								echo form_input($dat);
								
								 ?>
                                 
                                 <?php
                                                                $dat=array(
								'type'=>'reset',
								'value'=>'reset',
								'class'=>'btn btn-orange',
								
								);
								echo form_input($dat);
								
								 ?>
                                 
                                 </div>
                                                        <?php echo form_close()?>
                                        
                                        
                                        <!--end profile-->
                                        
                                        
                                    </div>
                                    <div class="tab-pane fade" id="user">

									<div id="employeeUpdateMessage"></div>
<?php $attributes = array("name" => "form", 'id' => 'updateEmployeeForm');
            echo form_open("manager/employees_crud/update/".$id, $attributes);?>
            
            <div class="form-group">
                                                    <label>Full Names</label>
                                                    
                                                    <input type="text" class="form-control" value="<?php echo $fn; ?>" name="u_fullnames"  placeholder="Fullnames" id="u_fullnames">
                                                </div>
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input type="number" class="form-control" placeholder="Phone number" name="u_phone" autocomplete="off" value="<?php echo $phone; ?>"  id="u_phone">
                                                </div>
                                                <div class="form-group">
                                                    <label>IDNO</label>
                                                   <input type="text" readonly="readonly" class="form-control" value="<?php echo $idno; ?>" name="u_idno"  placeholder="idno" id="u_idno">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                   <input type="text" readonly="readonly" class="form-control" value="<?php echo $email; ?>" name="u_email"  placeholder="email" id="u_email">
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                   <input type="text" class="form-control" value="<?php echo $address ?>" name="u_address"  placeholder="address" id="u_address">
                                                </div>
                                                <br />
                                                <button type="submit" id="btnSave" class="btn btn-green">Update Employee</button>
                                                <button type="reset" class="btn btn-orange"> <i class="fa fa-eraser"></i> Reset</button>

<?php echo form_close();?>
                                        
                                        
                                    </div>
                               </div>                 

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
	<script src="<?php echo base_url(); ?>components/custom_js/employee.js"></script>