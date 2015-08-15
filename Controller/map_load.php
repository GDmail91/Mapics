<?
	include '../Class/mapLoad.php';

	$maps = new mapLoad;

	$maps->getMap($_POST['map_id']);
?>