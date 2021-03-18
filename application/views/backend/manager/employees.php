<?php 

			date_default_timezone_set('Africa/Nairobi');
			$str_date=strtotime(date("m/d/Y"));
?>
                            
			
             <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Manage Employees</h4>
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
                                    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-building-o"></i> Current Employees</a>
                                    </li>
                                    <li><a href="#profile" data-toggle="tab"><i class="fa fa-plus-circle"></i> Add Employee</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="home">
                                    
                                    <div class="pull-right button-tooltips">
                                         <div class="btn-group" style="display:block;">
                                         <a href="#" onclick="printDiv('printer')" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i> Print
                                                    </a>
                                    	</div>
                                    </div>
                                        
                                        <!--manage profile-->
                                    	<div class="table-responsive">
                                        <div id="printer">
                                    <table class="table table-striped table-bordered table-hover table-green"  id="example-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th></th>
                                                <th>Employee Name</th>
                                                <th>Date Registered</th>
                                                <!--<th>Approval</th>-->
                                                <th>Shift</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											 <?php
                                                //$where="deleted_supplier='0'";
                                                $this->db->select('*');
                                                $this->db->from('users');
                                                $this->db->order_by('id','desc');
                                                //$this->db->where($where);
                                                $desc	=	$this->db->get()->result_array();
                                    $i=1;
                                    foreach($desc as $row):
                                                $id=$row['id'];
                                                $fn=$row['fullnames'];
                                                $email=$row['email'];
                                                $phone=$row['phone'];
                                                $address=$row['address'];
                                                $idno=$row['idno'];
                                                $login_id=$row['login_id'];
                                                $approval=$row['approval'];
                                                $date=$row['date_reg'];
                                    
                                            ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $i++; ?></td>
                                                
                                                <td>
                                                    <img class="img-circle" src="<?php echo $this->crud->get_image_url('user',$login_id);?>" alt="<?php echo $fn;?>" width="40px" height="40px">
                                                </td>
                                                <td><?php echo $fn; ?></td>
                                                <td><?php echo date('d'.'/'.'m'.'/'.'Y',$date); ?></td>
                                                <?php /*?><td><?php if($approval=='0'){echo 'Approved';}; ?></td><?php */?>
                                                <td>
                                                <?php
                                                    $where="duration_to>=".$str_date." AND employee_id=".$id." AND schedule_status=0";
													$this->db->select('*');
													$this->db->from('schedules');
													$this->db->where($where);
													$desc	=	$this->db->get()->result_array();
													foreach($desc as $row){
														$schedule_status=$row['schedule_status'];
														if($schedule_status=="0"){
												?>
                                                	<span class="badge blue"><i class="fa fa-check"></i> Assigned</span>
                                                <?php }
													}?>
                                                </td>
                                                <td class="center">
                                                
                                              <div class="btn-group">
                                        <button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown">Action
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" onclick="showAjaxModal('<?php echo base_url();?>manager/employees_crud/edit/<?php echo $id;?>');"><small><i class="fa fa-edit"></i> Edit</small></a>
                                            </li>
                                            <?php /*?><li>
                                              <a href="<?php echo base_url().'manager/employees_crud/view/'.urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($id)))))))).'' ?>"><small><i class="fa fa-arrow-circle-right"></i> View</small></a>
                                            </li><?php */?>
                                            <li><a href="#" onclick="confirm_modal('<?php echo base_url();?>manager/employees_crud/delete/<?php echo $login_id;?>');"><small><i class="fa fa-trash-o"></i> Delete</small></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /btn-group -->
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                        
                                       
                                        
                                    </div>
                                    
                                    <div class="tab-pane fade" id="profile">
                                        
                                        <!--add users form starts here-->
                                        <div class="row">
                                        <div class="col-lg-8">
                    
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div id="EmployeeMessage"></div>
                                                </div>
                                            </div>
                                            
                                        	 <?php $attributes = array("name" => "form", 'id'=>'employeeForm',"encytype"=>"multipart/form-data");
            echo form_open("manager/validate_register", $attributes);?>
                                <label>Full Names:</label>
                                <div class="form-group">
                                <?php
                                        $data=array(
                                            'name'=> 'fullnames',
                                            'type'=>'text',
                                            'id'=>'fullnames',
                                            'placeholder'=>'Full Names',
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
                                            'name'=> 'username',
                                            'type'=>'text',
                                            'id'=>'username',
                                            'placeholder'=>'username',
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
                                 
                                 <input type="hidden" name="d" value="<?php echo date('Ymd')?>">
                                 
                                </div>
                                                    
												 
                                        </div>
                                        <!--end of nested co-lg-8-->
                                        
                                        <!--satrt of nested co-lg-4-->
                                        	<div class="col-lg-4">
                                             
                                        <h4>Employee Picture :</h4>

                    <a href="#">
                        <img class="img-responsive img-profile" src="<?php echo base_url().'uploads/temp.jpg'?>"  alt="User Image" >
                    </a>
                                            	<div class="form-group">
                                                                <label>Chose a new Picture</label>
                              
                                                                <?php
                                                                $dat=array(
								'type'=>'file',
								'name'=> 'userfile',
								'accept'=>'image/*',
								'id'=>'userfile',
								
								);
								echo form_input($dat);
								
								 ?>
                                                                <p class="help-block"><i class="fa fa-warning"></i> Formats (jpg, png, gif, JPG, PNG, GIF)</p>
                                            </div>
                                        <!--end of nested co-lg-4-->
                                        
                                        </div>
                                        <div class="col-lg-12">
                                                       <button type="submit" class="btn btn-green"><i class="fa fa-plus-circle"></i> Register</button>
                                                        <button type="reset" class="btn btn-orange"><i class="fa fa-eraser"></i> Reset</button>                                                     
                                                        </div>
                                            <?php echo form_close(); ?>
                                        <!--add users form ends here-->
                                    </div>
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
                </div>
                
                <!--end tabs row -->