<?php 
			
	// error_reporting(0);

	require('getid3/getid3.php');

	$get = new getID3;


	$ip = $_POST['ip'];
	$date = $_POST['date'];
	$date = explode('-', $date);

	$year  = $date[0];
	$month = $date[1];
	$day   = $date[2];

	
	$year_dir  = 'y' . $year;
	$month_dir = 'm' . $month;
	$day_dir   = 'd' . $day;

	$full_dir = __DIR__ . '/video/' . $year_dir . '/' . $month_dir . '/' . $day_dir;

	$videos = scandir($full_dir);

	// $ip = rtrim($_GET['ip'] );
	// echo $ip;
	$ip = explode(' . ', $ip);
	$ip = 'i'.$ip[0].'_'.$ip[1].'_'.$ip[2].'_'.$ip[3];

	$i = 0 ; 
	foreach ($videos as $video ) {
		if($video !== '.' && $video !== '..'){

			$info = $get->analyze($full_dir . '/' .$video);
			
			$duration = $info['playtime_string'];

			$duration_by_parts = explode(':', $duration);
		   $duration_by_parts[0]  < 10 ? $duration_by_parts[0] = '0' . $duration_by_parts[0] : '';
		   
		   $duration_by_parts[1]  < 10 ? $duration_by_parts[1] = '0' . $duration_by_parts[0] : '';
			$duration = '00:'.$duration_by_parts[0] . ':' . $duration_by_parts[1];

			// echo $duration; /
			

			$video = explode('t', $video); 
				// echo $video[0] . "<br>";
			if( $video[0] === $ip){
				
				$file = explode('.', $video[1]);	
				$file = explode('_' , $file[0]);

				// echo "<pre";
				// print_r($file);
				// echo "</pre>";
				$time[$i] = $file[0] . ":" . $file[1] . ":" . $file[2];
				// echo $duration;
				// $secs = strtotime($duration) - strtotime("00:00:00");
				$secs = strtotime($duration)-strtotime("00:00:00");
				// $result = date("H:i:s",strtotime($time)+$secs);
				$end_time[$i] = date("H:i:s",strtotime($time[$i])+$secs);
				// echo $result;

				$full_date[$i] = $year . '-' . $month . '-' . $day . 'T' . $file[0] . ':' . $file[1] . ":" . $file[2];
				$full_end_time[$i] = $year . '-' . $month . '-' . $day . 'T' . $end_time[$i];


				$endtime[$i] = 
				$items[$i] = array(
					'id' => $i,
					'content' => 'Video',
					'start'	  =>  $full_date[$i],
					'end' 	  =>  $full_end_time[$i]
					
				);

				$i++;
				
			}
		}

	}


	// echo "<pre>";
	// print_r($time);
	// echo "</pre>";
	echo json_encode($items);
 ?>