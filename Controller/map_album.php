<?
	include '../Class/mapLoad.php';

	$mapLoad = new mapLoad;

	$map_album = $mapLoad->getMap($_POST['map_id']);

	echo urldecode( json_encode ( $map_album )) ;

?>