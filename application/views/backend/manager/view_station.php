  <script src="<?php echo base_url(); ?>components/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>components/js/search/searchindex.js"></script>
  <?php foreach($station_id->result() as $row):
$station_id=$row->station_id;
$station_name=$row->station_name;
$date_added=$row->date_added;

endforeach;

//count shifts on this station
$ol="station_id=".$station_id."";
$this->db->select('*');
$this->db->from('shifts');
$this->db->where($ol);
$count_shifts	=	$this->db->count_all_results();

//count scheduled based on station
$ol="station_id=".$station_id."";
$this->db->select('*');
$this->db->from('schedules');
$this->db->where($ol);
$count_schedules	=	$this->db->count_all_results();

//count active scheduled based on station
$ol="station_id=".$station_id." AND schedule_status='0'";
$this->db->select('*');
$this->db->from('schedules');
$this->db->where($ol);
$count_active	=	$this->db->count_all_results();
?>
 <div class="row">
                    <div class="col-lg-12">

                        <div class="portlet portlet-default">
                            <div class="portlet-body">
                                <ul id="userTab" class="nav nav-tabs">
                                    <li class="active"><a href="#overview" data-toggle="tab">Overview</a>
                                    </li>
                                </ul>
                                <div id="userTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="overview">

                                        <div class="row">
                                            <div class="col-lg-2 col-md-3">
                                            <br>
                                                <div class="list-group">
                                                    <a href="#" class="list-group-item active">Overview</a>
                                                    <a href="#" class="list-group-item">Shifts<span class="badge green"><?php echo $count_shifts;?></span></a>
                                                    <a href="#" class="list-group-item">Scheduled<span class="badge orange"><?php echo $count_schedules;?></span></a>
                                                    <a href="#" class="list-group-item">Active<span class="badge blue"><?php echo $count_active;?></span></a>
                                                </div>
                                            </div>
                                            <div class="col-lg-7 col-md-5">
                                                <h2><i class="fa fa-home"></i> Station: <?php echo $station_name;?></h2>
                                                <p></p>
                                                <ul class="list-inline">
                                                    <li><i class="fa fa-calendar fa-muted"></i> Station Since: <?php echo date('m/d/Y',$date_added);?></li>
                                                </ul>
                                                <hr>
                                                <h3>Current Shifts (<?php echo $count_shifts;?>)</h3>
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-green" type="button">Search</button>
                                                    </span>
                                                    <input type="text" name="filter" id="filter" placeholder="Search Shift" autocomplete="off" class="form-control"; />  
                                                </div>
                                                <!-- /input-group -->
                                                <br>
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Shift Name</th>
                                                                <th>From-To</th>
                                                                <th>Duration</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
															 <?php
                                                                $where="station_id=".$station_id."";
                                                                $this->db->select('*');
                                                                $this->db->from('shifts');
                                                                $this->db->order_by('station_id','asc');
                                                                $this->db->where($where);
                                                                $desc	=	$this->db->get()->result_array();
																$i=1;
																foreach($desc as $row):
																			$shift_id=$row['shift_id'];
																			$shift_name=$row['shift_name'];
																			$start_time=$row['start_time'];
																			$end_time=$row['end_time'];
																			$hours_worked=$row['hours_worked'];
                                                    
                                                            ?>
                                                            <tr class="odd gradeX">
                                                                <td><?php echo $i++;?></td>
                                                                <td><?php echo $shift_name;?></td>
                                                                <td><?php echo date("h:i a",$start_time)?> - <?php echo date("h:i a",$end_time)?></td>
                                                                <td><?php echo $hours_worked;?> hours</td>
                                                                <td>
                                                                <?php
                                                                $where="station_id=".$station_id." AND shift_id=".$shift_id." AND schedule_status='0'";
                                                                $this->db->select('*');
                                                                $this->db->from('schedules');
                                                                $this->db->where($where);
                                                                $desc	=	$this->db->get()->result_array();
																foreach($desc as $row):
																$schedule_status=$row['schedule_status'];
																
																if($schedule_status=="0"){
																?>
                                                                <a class="btn btn-xs btn-green disabled"><i class="fa fa-clock-o"></i> Active</a>
                                                                <?php }else{?>
                                                                <a class="btn btn-xs btn-orange disabled"><i class="fa fa-clock-o"></i> Not scheduled</a>
                                                                <?php }endforeach ?>
                                                                </td>
                                                            </tr>
                                        					<?php endforeach; ?>
                                                            <?php if($count_shifts=='0'){?>
                                                            <tr><td colspan="5">There are no Shifts available in this station</td></tr>
                                                            <?php }?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-4">
                                                <h3></h3>
                                                <a href="<?php echo base_url()?>manager/stations" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back to Stations</a>
                                        		<hr>
                                                <div id="buttons" class="panel-collapse collapse in">
                                                        <a href="#" onclick="showAjaxModalSmall('<?php echo base_url();?>manager/stations_crud/edit/<?php echo $station_id;?>');" class="btn btn-green">Edit Station</a>
                                                        <?php if($count_shifts<3){?>
                                                        <a class="btn btn-blue" onclick="showAjaxModalSmall('<?php echo base_url();?>manager/stations_crud/add_shift/<?php echo $station_id;?>');">Add Shift</a>
                                                        <?php }?>
                                                        <hr>
                                                        <h4>Quick Links</h4>
                                                            <ul class="nav nav-pills nav-stacked">
                                                                <li><a href="<?php echo base_url().'manager/manage' ?>"><i class="fa fa-angle-double-right"></i> Manage Shifts</a>
                                                                </li>
                                                                <li><a href="<?php echo base_url().'manager/schedule' ?>"><i class="fa fa-angle-double-right"></i> Manage Schedules</a>
                                                                </li>
                                                            </ul>
                                                    </div>

                                            </div>
                                        </div>

                                    </div>
                                    
                                </div>
                            </div>
                            <!-- /.portlet-body -->
                        </div>
                        <!-- /.portlet -->


                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->