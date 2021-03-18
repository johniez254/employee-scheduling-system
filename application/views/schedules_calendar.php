<?php
$user_id= $this->session->userdata('id');
$id=$this->db->get_where('users' , array('login_id'=>$user_id))->row()->id;
?>
<script>
  $(document).ready(function() {
	  
	  var calendar = $('#calendar');
				
				$('#calendar').fullCalendar({
					 header: {
            left: 'prev,next today',
           	center: 'title',
            right: 'month,agendaWeek,agendaDay'
       },
					
					//defaultView: 'basicWeek',
					
					editable: false,
					firstDay: 1,
					height: 530,
					droppable: false,		
					
					events: [						
						 <?php 
							$where="employee_id=".$id."";
											$this->db->select('*');
											$this->db->from('schedules');
											$this->db->where($where);
											$this->db->order_by('schedule_id','desc');
											$this->db->join('users', 'users.id = schedules.employee_id');
											$this->db->join('shifts', 'shifts.shift_id = schedules.shift_id');
											$this->db->join('station', 'station.station_id = schedules.station_id');
											$desc	=	$this->db->get()->result_array();
											$i='1';
											foreach($desc as $row):
											$schedule_id=$row['schedule_id'];
											$employee_name=$row['fullnames'];
											$shift_name=$row['shift_name'];
											$start_time=$row['start_time'];
											$end_time=$row['end_time'];
											$duration_from=$row['duration_from'];
											$duration_to=$row['duration_to'];
											$station_name=$row['station_name'];
											$schedule_status=$row['schedule_status'];
											
											$today_date=date('m/d/Y');
											$start_date=date('m/d/Y',$duration_from);
											
											$start=new DateTime($today_date);
											$end=new DateTime($start_date);
											$interval=$start->diff($end);
											$t_days_difference=$interval->format('%R');
						?>
						{
							<?php  if($schedule_status=='1') {?>
							className: '<?php echo'fc-orange'; ?>',
							title: "<?php echo $station_name. ' (';?> <?php echo $shift_name. ' )';?>",
							start: new Date(<?php echo date('Y',$duration_from);?>, <?php echo date('m',$duration_from)-1;?>, <?php echo date('d',$duration_from);?>),
							end:	new Date(<?php echo date('Y',$duration_to);?>, <?php echo date('m',$duration_to)-1;?>, <?php echo date('d',$duration_to);?>) 
						<?php  }elseif ($t_days_difference=="+"){?>
							className: '<?php echo'fc-default'; ?>',
							title: "<?php echo $station_name. ' (';?> <?php echo $shift_name. ' )';?>",
							start: new Date(<?php echo date('Y',$duration_from);?>, <?php echo date('m',$duration_from)-1;?>, <?php echo date('d',$duration_from);?>),
							end:	new Date(<?php echo date('Y',$duration_to);?>, <?php echo date('m',$duration_to)-1;?>, <?php echo date('d',$duration_to);?>) 
							<?php }else{?>
							className: '<?php echo'fc-green'; ?>',
							title: "<?php echo $station_name. ' (';?> <?php echo $shift_name. ' )';?>",
							start: new Date(<?php echo date('Y');?>, <?php echo date('m')-1;?>, <?php echo date('d');?>),
							end:	new Date(<?php echo date('Y',$duration_to);?>, <?php echo date('m',$duration_to)-1;?>, <?php echo date('d',$duration_to);?>) 
						
						<?php }?>
						},	
						
						<?php endforeach;?>
					]
				});
	});

</script>