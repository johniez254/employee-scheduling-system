<?php
$user_id= $this->session->userdata('id');
$role=$this->db->get_where('login' , array('id'=>$user_id))->row()->role;
?>
<?php if($role=="manager"){?>
<?php
$count_schedules=$this->db->count_all('schedules');
?>

<script type="text/javascript">


    $(function () {
        CanvasJS.addColorSet("ColourShades",
                [//colorSet Array
 
                "#2980b9", //blue 
                "#16a085",//green colour
                "#f39c12", //orange 
                "#8e44ad", //purple 
                "#e74c3c",//red colour           
                ]);
        var chart = new CanvasJS.Chart("top_employees_reports", {
			colorSet: "ColourShades",
            theme: "light2",
            animationEnabled: true,
            title: {
				<?php if($count_schedules=="0"){?>
                text: "No data available"
				<?php }else{?>
				text: ""
				<?php }?>
            },
            exportFileName: "Top scheduled employees bar chart",
            exportEnabled: true,
            axisY: {
                title: "Days Worked/Assigned",
                reversed: false
            },
            data: [
            {
                type: "column",
                dataPoints: [
				<?php
					$this->db->select('*');
					$this->db->from('schedules');
					$this->db->select_sum('days_assigned');
					$this->db->group_by('employee_id');
					$this->db->order_by('days_assigned', 'desc');
					$this->db->limit('5');
					$this->db->join('users', 'users.id = schedules.employee_id');
					$desc=$this->db->get()->result_array();
					foreach($desc as $row):
				?>
                    { y: <?php echo $row['days_assigned'];?>, label: "<?php echo $row['fullnames'];?>" },
					
				<?php endforeach;?>
                ]
            }
            ]
        });
        chart.render();
    });
</script>


<script type="text/javascript">

    $(function () {
        var chart7 = new CanvasJS.Chart("combined_schedules_reports", {
            theme: "light2",
            title: {
				<?php if($count_schedules=="0"){?>
                text: "No data available"
				<?php }else{?>
				text: ""
				<?php }?>
            },
            exportFileName: "Daily Number of Employees Scheduled spline chart",
            exportEnabled: true,
        	zoomEnabled: true,
            animationEnabled: true,
            axisY: {
                title: "Employees Scheduled",
				valueFormatString: "#0.##",
                //valueFormatString: "#0,,.",
                suffix: " "
            },
            axisX: {
                valueFormatString: "DD MMM",// YYYY
                interval: 1,//change interval based on duration
                intervalType: "day"
            },
			 data: [
            {
                toolTipContent: "{y} employees",
			    type: "splineArea",
			    markerSize: 5,
				//color: "rgba(52, 73, 94, 0.89)",//pale dark blue
				color: "rgba(22, 160, 133, 0.87)",//green
			    //color: "rgba(54,158,173,.7)",
                xValueType: "dateTime",
                dataPoints: [
				<?php
					$this->db->select('*');
					$this->db->from('schedules');
					$this->db->select_sum('s_count');
					$this->db->group_by('date_scheduled');
					$w=$this->db->get()->result_array();
					foreach($w as $row):
				?>
					{"x":<?php echo $row['date_scheduled']*1000;?>,"y":<?php echo $row['s_count'];?>},
					
				<?php endforeach;?>
                ]
            }
            ]
        });

        chart7.render();
    });
</script>


<!--//swap dough chart-->
<?php
//$tp="employee_from=".$employee_id."";
$this->db->select('*');
$this->db->from('swap');
//$this->db->where($tp);
$count_swaps	=	$this->db->count_all_results();

$tp="s_status='0'";
$this->db->select('*');
$this->db->from('swap');
$this->db->where($tp);
$s_pending	=	$this->db->count_all_results();


$ta="s_status='1'";
$this->db->select('*');
$this->db->from('swap');
$this->db->where($ta);
$s_approved	=	$this->db->count_all_results();


$td="s_status='3'";
$this->db->select('*');
$this->db->from('swap');
$this->db->where($td);
$s_declined	=	$this->db->count_all_results();

    $dataSwaps = array(
        array("y" => $s_pending, "legendText" => "Pending", "label" => "Pending"),
        array("y" => $s_approved, "legendText" => "Approved", "label" => "Approved"),
        array("y" => $s_declined, "legendText" => "Declined", "label" => "Declined"),
    );
?>

<script type="text/javascript">
    $(function () {
        CanvasJS.addColorSet("ColourShades",
                [//colorSet Array

                "#f39c12", //orange 
                "#16a085",//green colour
                "#e74c3c",//red colour             
                ]);
        var chart3 = new CanvasJS.Chart("swaps_pie_chart", {
            colorSet: "ColourShades",
            title: {
				<?php if($count_swaps=="0"){?>
                text: "No data available"
				<?php }else{?>
				text: ""
				<?php }?>
            },
			exportFileName: "doughnut Chart",
            exportEnabled: true,
            animationEnabled: true,
            legend: {
                fontSize: 10,
                verticalAlign: "center",
                horizontalAlign: "right",
                //fontFamily: "Helvetica"
            },
            theme: "light2",
            data: [
            {
                type: "doughnut",
                //indexLabelFontFamily: "Garamond",
				innerRadius: 50,
                indexLabelFontSize: 10,
                indexLabel: "{label} {y}",
                startAngle: -20,
                showInLegend: true,
				percentFormatString: "#0.##",
				toolTipContent: "{legendText} {y}",
                dataPoints: <?php echo json_encode($dataSwaps, JSON_NUMERIC_CHECK); ?>
            }
            ]
        });
        chart3.render();
    });
</script>

<?php
//count time offs 
//$tp="employee_id=".$employee_id."";
$this->db->select('*');
$this->db->from('time_off');
//$this->db->where($tp);
$count_time_off	=	$this->db->count_all_results();

$tp="request_status='0'";
$this->db->select('*');
$this->db->from('time_off');
$this->db->where($tp);
$t_pending	=	$this->db->count_all_results();


$ta="request_status='2'";
$this->db->select('*');
$this->db->from('time_off');
$this->db->where($ta);
$t_approved	=	$this->db->count_all_results();


$td="request_status='3'";
$this->db->select('*');
$this->db->from('time_off');
$this->db->where($td);
$t_declined	=	$this->db->count_all_results();

//echo $t_approved. $t_declined. $t_pending;
$time_off_array = array(
	array("y" => $t_pending, "legendText" => "Pending", "label" => "Pending"),
	array("y" => $t_approved, "legendText" => "Approved", "label" => "Approved"),
	array("y" => $t_declined, "legendText" => "Declined", "label" => "Declined"),
    );

?>

<script>
 $(function () {
        CanvasJS.addColorSet("ColourShades",
                [//colorSet Array

                "#f39c12", //orange 
                "#16a085",//green colour
                "#e74c3c",//red colour             
                ]);
        var chart4 = new CanvasJS.Chart("time_off_pie", {
            colorSet: "ColourShades",
            title: {
				<?php if($count_time_off=="0"){?>
                text: "No data available"
				<?php }else{?>
				text: ""
				<?php }?>
            },
			exportFileName: "Pie Chart",
            exportEnabled: true,
            animationEnabled: true,
            legend: {
                verticalAlign: "center",
                horizontalAlign: "right",
                fontSize: 10,
                //fontFamily: "Helvetica"
            },
            theme: "light2",
            data: [
            {
                type: "pie",
                indexLabelFontSize: 10,
                indexLabel: "{label} {y}",
                startAngle: -10,
                showInLegend: true,
				percentFormatString: "#0.##",
				toolTipContent: "{legendText} {y}",
                dataPoints: <?php echo json_encode($time_off_array, JSON_NUMERIC_CHECK); ?>
            }
            ]
        });
        chart4.render();
    });

</script>

<?php }?>

<?php if ($role=="user"){
	
$employee_id=$this->db->get_where('users' , array('login_id'=>$user_id))->row()->id;
	?>

<?php
//count time offs 
$tp="employee_id=".$employee_id."";
$this->db->select('*');
$this->db->from('time_off');
$this->db->where($tp);
$count_time_off	=	$this->db->count_all_results();

$tp="employee_id=".$employee_id." AND request_status='0'";
$this->db->select('*');
$this->db->from('time_off');
$this->db->where($tp);
$t_pending	=	$this->db->count_all_results();


$ta="employee_id=".$employee_id." AND request_status='2'";
$this->db->select('*');
$this->db->from('time_off');
$this->db->where($ta);
$t_approved	=	$this->db->count_all_results();


$td="employee_id=".$employee_id." AND request_status='3'";
$this->db->select('*');
$this->db->from('time_off');
$this->db->where($td);
$t_declined	=	$this->db->count_all_results();

//echo $t_approved. $t_declined. $t_pending;
$time_off_array = array(
	array("y" => $t_pending, "legendText" => "Pending", "label" => "Pending"),
	array("y" => $t_approved, "legendText" => "Approved", "label" => "Approved"),
	array("y" => $t_declined, "legendText" => "Declined", "label" => "Declined"),
    );

?>

<script>
 $(function () {
        CanvasJS.addColorSet("ColourShades",
                [//colorSet Array

                "#f39c12", //orange 
                "#16a085",//green colour
                "#e74c3c",//red colour             
                ]);
        var chart1 = new CanvasJS.Chart("time_off_pie", {
            colorSet: "ColourShades",
            title: {
				<?php if($count_time_off=="0"){?>
                text: "No data available"
				<?php }else{?>
				text: ""
				<?php }?>
            },
			exportFileName: "Pie Chart",
            exportEnabled: true,
            animationEnabled: true,
            legend: {
                verticalAlign: "center",
                horizontalAlign: "right",
                fontSize: 10,
                //fontFamily: "Helvetica"
            },
            theme: "light2",
            data: [
            {
                type: "pie",
                indexLabelFontSize: 10,
                indexLabel: "{label} {y}",
                startAngle: -10,
                showInLegend: true,
				percentFormatString: "#0.##",
				toolTipContent: "{legendText} {y}",
                dataPoints: <?php echo json_encode($time_off_array, JSON_NUMERIC_CHECK); ?>
            }
            ]
        });
        chart1.render();
    });

</script>

<?php
$tp="employee_from=".$employee_id."";
$this->db->select('*');
$this->db->from('swap');
$this->db->where($tp);
$count_swaps	=	$this->db->count_all_results();

$tp="employee_from=".$employee_id." AND s_status='0'";
$this->db->select('*');
$this->db->from('swap');
$this->db->where($tp);
$s_pending	=	$this->db->count_all_results();


$ta="employee_from=".$employee_id." AND s_status='1'";
$this->db->select('*');
$this->db->from('swap');
$this->db->where($ta);
$s_approved	=	$this->db->count_all_results();


$td="employee_from=".$employee_id." AND s_status='3'";
$this->db->select('*');
$this->db->from('swap');
$this->db->where($td);
$s_declined	=	$this->db->count_all_results();

    $dataSwaps = array(
        array("y" => $s_pending, "legendText" => "Pending", "label" => "Pending"),
        array("y" => $s_approved, "legendText" => "Approved", "label" => "Approved"),
        array("y" => $s_declined, "legendText" => "Declined", "label" => "Declined"),
    );
?>

<script type="text/javascript">
    $(function () {
        CanvasJS.addColorSet("ColourShades",
                [//colorSet Array

                "#f39c12", //orange 
                "#16a085",//green colour
                "#e74c3c",//red colour             
                ]);
        var chart = new CanvasJS.Chart("swaps_pie_chart", {
            colorSet: "ColourShades",
            title: {
				<?php if($count_swaps=="0"){?>
                text: "No data available"
				<?php }else{?>
				text: ""
				<?php }?>
            },
			exportFileName: "doughnut Chart",
            exportEnabled: true,
            animationEnabled: true,
            legend: {
                fontSize: 10,
                verticalAlign: "center",
                horizontalAlign: "right",
                //fontFamily: "Helvetica"
            },
            theme: "light2",
            data: [
            {
                type: "doughnut",
                //indexLabelFontFamily: "Garamond",
				innerRadius: 50,
                indexLabelFontSize: 10,
                indexLabel: "{label} {y}",
                startAngle: -20,
                showInLegend: true,
				percentFormatString: "#0.##",
				toolTipContent: "{legendText} {y}",
                dataPoints: <?php echo json_encode($dataSwaps, JSON_NUMERIC_CHECK); ?>
            }
            ]
        });
        chart.render();
    });
</script>



<?php

$tp="employee_id=".$employee_id." AND schedule_status='0'";
$this->db->select('*');
$this->db->from('schedules');
$this->db->where($tp);
$s_active	=	$this->db->count_all_results();





                                        	$where="employee_id=".$employee_id." AND schedule_status='0'";
											$this->db->select('*');
											$this->db->from('schedules');
											$this->db->where($where);
											$this->db->join('shifts', 'shifts.shift_id = schedules.shift_id');
											$desc	=	$this->db->get()->result_array();
											$i='1';
											foreach($desc as $row):
											$days_assigned=$row['days_assigned'];
											$shift_name=$row['shift_name'];
											$start_time=$row['start_time'];
											$end_time=$row['end_time'];
											$duration_from=$row['duration_from'];
											$duration_to=$row['duration_to'];
											
	$scheduleData = array(
        array("x" => $start_time*1000, "y" => $days_assigned),
        array("x" => $end_time*1000, "y" => $days_assigned),
    );
											
											endforeach;
											
if($s_active=='0'){
	$scheduleData = array(
        array("x" => 0, "y" => 0),
        array("x" => 0, "y" => 0),
    );
}

?>

<script type="text/javascript">

    $(function () {
       var chart4 = new CanvasJS.Chart("schedules_line_report", {
            title: {
			<?php if($s_active!='0'){ ?>
                text: "Daily Shift Schedule"
				<?php }else{?>
				text: "No data available"
				<?php }?>
            },
            subtitles: [
                {
			<?php if($s_active!='0'){ ?>
                text: "From: <?php echo date('d/m/Y',$duration_from)?> To:  <?php echo date('d/m/Y',$duration_to)?>)"
				<?php }else{?>
				text: ""
				<?php }?>
                }
            ],
			exportFileName: "Date-Time Chart",
            exportEnabled: true,
            animationEnabled: true,
            axisY: {
                includeZero: true,
                prefix: ""
            },
            toolTip: {
                shared: true,
                content: "<span style='\"'color: {color};'\"'><strong>{name}:</strong></span> <span style='\"'color: dimgrey;'\"'>{y} days</span> "
            },
            legend: {
                fontSize: 10,
                fontFamily: "Helvetica"
            },
            theme: "light2",
            data: [
            {
                type: "splineArea",
                showInLegend: true,
                name: "Days Scheduled",
                markerSize: 0,
                color: "rgba(52, 73, 94, 0.89)",//pale blue
                //color: "rgba(54,158,173,.6)",//color default
                xValueType: "dateTime",                
                dataPoints: <?php echo json_encode($scheduleData, JSON_NUMERIC_CHECK); ?>
            },

            ]
        });

        chart4.render();
    });
</script>
<?php }?>