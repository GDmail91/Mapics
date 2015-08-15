<?
	include '../Class/mapLoad.php';

	$mapLoad = new mapLoad;

	$maps = $mapLoad->getMapAllCapture();

	for ($i=0; $i < count($maps); $i++) { 
		$mapArray['mapInfo'.$i] = $maps[$i];
	}
	echo(urldecode( json_encode ( $mapArray ))) ;

?>