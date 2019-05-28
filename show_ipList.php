<?php
//<!-- *************************************************************************** -->
  //    <!-- WHEN DATE CHOSEN IT FINDS ALL THE IP ADRESSESES FROM THAT DATE -->
//<!-- *************************************************************************** --> 
	error_reporting(1);
	// accessing a clicked day . Ex. 2019-02-02
	$date = $_POST['date'];	
	$date = explode('-',$date);

	$month = $date[1];
	$day = $date[2];
	

	$year_dir = 'y' . $date[0];
	$month_dir = 'm' . $month;
	$day_dir	= 'd'. $day;

	$full_dir = __DIR__ . '/video/' . $year_dir . '/' . $month_dir . '/' . $day_dir;
	// echo $full_dir;
		
	$ips = scandir($full_dir);

	// $ip = $ips[5];

	$i = 0;
	foreach ($ips as $ip) {
		if( $ip !== '.' && $ip !== '..'){
		$ip_list[$i] = substr($ip, 1 , strpos($ip,'t') - 1);
		$ip = explode( '_' , $ip_list[$i]);
		$ip_list[$i] = $ip[0] . ' . '. $ip[1] . ' . '. $ip[2] . ' . '. $ip[3]; 
		$i++;
		}
	}

	
		$ip = array_values(array_unique($ip_list));
		// $ip = ($ip);

	
	// echo "<pre>";
	// print_r($ip);
	// echo "</pre>";
	// foreach (glob($full_dir."/*.avi" , GLOB_NOSORT) as $video) {
 //    	// echo "$filename size " . $filename . "\n";
 //    	echo $video . '\n';
	// }

	if(!empty($ip)){
		echo json_encode($ip);
	 }else{
	 	echo json_encode(json_decode ("{}"));
	 }
	
	

 ?>