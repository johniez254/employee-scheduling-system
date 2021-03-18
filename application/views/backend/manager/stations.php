
                            
			
             <!-- Basic Tabs Example -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Manage Stations</h4>
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
                                    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-building-o"></i> Current Stations</a>
                                    </li>
                                    <li><a href="#profile" data-toggle="tab"><i class="fa fa-plus-circle"></i> Add Station</a>
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
                                                <th>Station</th>
                                                <th>Shifts</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											 <?php
                                                //$where="deleted_supplier='0'";
                                                $this->db->select('*');
                                                $this->db->from('station');
                                                $this->db->order_by('station_id','asc');
                                                //$this->db->where($where);
                                                $desc	=	$this->db->get()->result_array();
                                    $i=1;
                                    foreach($desc as $row):
                                                $sid=$row['station_id'];
                                                $sn=$row['station_name'];
                                                $status=$row['status'];
                                                $sdate=$row['date_added'];
                                    
                                            ?>
                                            <tr class="odd gradeX">
                                                <td style="width:150px;"><?php echo $i++; ?></td>
                                                <td><?php echo $sn; ?></td>
                                                <td>
                                                <?php
                                                	$ol="station_id=".$sid."";
													$this->db->select('*');
													$this->db->from('shifts');
													$this->db->where($ol);
													$count_shifts	=	$this->db->count_all_results();
													
													
													if($count_shifts!='0'){
														echo $count_shifts.' Shifts (';
													$where="station_id=".$sid."";
													$this->db->select('*');
													$this->db->from('shifts');
													$this->db->where($where);
													$desc	=	$this->db->get()->result_array();
													foreach($desc as $row):
														$shift_name=$row['shift_name'];
														echo strtolower($shift_name).',';
													endforeach;
													echo ")";
													}else{
													echo $count_shifts.' Shifts';
													}
													
												?>
                                                </td>
                                                <td class="center">
                                                
                                              <div class="btn-group">
                                        <button type="button" class="btn btn-green dropdown-toggle btn-xs" data-toggle="dropdown">Action
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" onclick="showAjaxModalSmall('<?php echo base_url();?>manager/stations_crud/edit/<?php echo $sid;?>');"><small><i class="fa fa-edit"></i> Edit</small></a>
                                            </li>
                                            <li>
                                              <a href="<?php echo base_url().'manager/stations_crud/view_station/'.urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode(urlencode(base64_encode($sid)))))))).'' ?>"><small><i class="fa fa-arrow-circle-right"></i> View</small></a>
                                            </li>
                                            <li><a href="#" onclick="confirm_modal('<?php echo base_url();?>manager/stations_crud/delete/<?php echo $sid;?>');"><small><i class="fa fa-trash-o"></i> Delete</small></a>
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
                                        
                                        
                                        <!--password-->
            
                                                            <div id="stationMessage"></div>
                                        
                                         <?php $attributes = array("name" => "form", 'id' => 'stationForm');
            echo form_open("manager/validate_station", $attributes);?>
                                                            <div class="form-group">
                                                          
                                                                <label>Add Station:</label>
                 <?php 
								$data=array(
								'name'=> 'station',
								'type'=>'text',
								'placeholder'=>'Add station',
								'class'=>'form-control',
								'id'=>'station',
								'value'=>set_value('station'),
								'autocomplete'=>'off'
								
								);
								echo form_input($data);
															
								 ?>
                                 <input type="hidden" name="d" value="<?php echo date('Ymd');?>" />
                                        
                                    </div>
                                                            
                                                         
                                                            <?php 
								$data=array(
								'type'=>'submit',
								'class'=>'btn btn-green',
								'value'=>'Add Station',
								
								);
								echo form_submit($data);
								?>
                                                            
                                                            <?php echo form_close() ?>
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
