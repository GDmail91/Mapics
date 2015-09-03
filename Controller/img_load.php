<?
	include '../Class/mapLoad.php';

	$mapLoad = new mapLoad;

	$img_info = $mapLoad->get_image($_POST['img_id']);

	echo urldecode( json_encode ( $img_info ));

?>