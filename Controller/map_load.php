<?
	include '../Class/mapLoad.php';

	$mapLoad = new mapLoad;

	if ($_POST['num']) {
		$maps = $mapLoad->getMapCaptureById($_POST['user_id'], $_POST['num']);
	} else {
		$maps = $mapLoad->getMapCaptureById($_POST['user_id']);
	}

	for ($i=0; $i < count($maps); $i++) { 
		$mapArray['mapInfo'.$i] = $maps[$i];
	}
	echo urldecode( json_encode ( $mapArray ));

?>