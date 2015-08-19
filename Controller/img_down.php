<?
	include '../Class/mapLoad.php';

	$maps = new mapLoad;


	for ($i=0; $i < 10; $i++) { 
		$mapArray['mapInfo'.$i] = $maps->getMap(2);
			
		// $resultArray에 담기
		//array_push($mapArray, $tempArray);  
	}
	
	echo(urldecode( json_encode ( $mapArray ))) ;

?>