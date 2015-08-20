<?
	include '../Class/mapLoad.php';

	$mapLoad = new mapLoad;

	if ($_POST['num'])
		$maps = $mapLoad->getMapAllCapture($_POST['num']);
	else	
		$maps = $mapLoad->getMapAllCapture();

	for ($i=0; $i < count($maps); $i++) { 
		$mapArray['mapInfo'.$i] = $maps[$i];
	}
	echo(urldecode( json_encode ( $mapArray ))) ;

?>