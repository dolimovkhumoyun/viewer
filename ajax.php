
<?php
// <!-- *************************************************************************** -->
// <!-- THIS SCRIPT is SENT BY ZABUTO CALENDAR TO KNOW THE DATES WHERE VIDEOS EXIST -->
// <!-- *************************************************************************** -->
	error_reporting(1);
	
	// echo $dir;	
	if ( !empty($_GET['year']) && !empty($_GET['month']) )  {
		
		$year_in = $_GET['year'] ;
		$month_in = $_GET['month'] ;

		if ($month_in < 10) {
				$month_in = '0' . $month_in;

		}	
		$year_dir = 'y'.$year_in;
		$month_dir = 'm'.$month_in;

		$dir = __DIR__ . '/video'. '/' . $year_dir . '/' . $month_dir;
		if(file_exists($dir) || is_dir($dir)){		
			$day = scandir($dir);
			$dates = array();

			$i = 0;
			foreach ($day as $days) {
					
					if( $days !== '.' && $days !== '..'){
						$days = explode('d', $days);

						$date = $year_in . '-' . str_pad($month_in, 2, '0', STR_PAD_LEFT) . '-' . str_pad($days[1], 2, '0', STR_PAD_LEFT);
						
						$dates[$i] = array(
							'date' => $date, 
		           			'badge' => true,
		           			'title' => 'Example for ' . $date,
						);
						$i++;
					}
			}
			echo json_encode($dates);

		}
}else{
	echo json_encode(array());
}
  











