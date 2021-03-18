 <div class="row">
 <!-- Pie Chart Example -->
                    <div class="col-lg-6">
                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Top Scheduled Employees</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a href="javascript:;"><i class="fa fa-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#donutChart"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="donutChart" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div style="min-height:430px; overflow:auto">
                                        <div class="flot-chart-content" id="top_employees_reports"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-6 -->
                    
                    
                    <div class="col-lg-6">
                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Daily Number of Schedules</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <a href="javascript:;"><i class="fa fa-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#donutChart"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="donutChart" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div style="min-height:430px; overflow:auto">
                                        <div class="flot-chart-content" id="combined_schedules_reports"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-6 -->
                    
</div>
<?php

?>
 <div class="row">
 <!-- Pie Chart Example -->
                     <div class="col-lg-6">
                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Time Offs Pie Chart Report</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#defaultPortlet"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="defaultPortlet" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    
                                    <div class="flot-chart">
                                        <div class="flot-chart-content" id="time_off_pie"></div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="portlet-footer">
                            	<div class="btn-toolbar" role="toolbar">
                                	<a href="<?php echo base_url()?>manager/time_off" class="btn btn-green pull-right"><i class="fa fa-arrow-circle-right"></i> View Time Offs</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-6 -->

                    <div class="col-lg-6">
                        <div class="portlet portlet-default">
                            <div class="portlet-heading">
                                <div class="portlet-title">
                                    <h4>Swap Pie Chart Report</h4>
                                </div>
                                <div class="portlet-widgets">
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion" href="#greenPortlet"><i class="fa fa-chevron-down"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="greenPortlet" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                	
                                    <div class="flot-chart">
                                        <div class="flot-chart-content" id="swaps_pie_chart"></div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="portlet-footer">
                                
                            	<div class="btn-toolbar" role="toolbar">
                                	<a href="<?php echo base_url() ?>manager/schedule_swap" class="btn btn-green pull-right"><i class="fa fa-arrow-circle-right"></i> View Swaps</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-6 -->
                    
</div>
