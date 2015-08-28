<?
	include '../Class/mapLoad.php';

	$mapLoad = new mapLoad;
	
	if ($mapLoad->set_description($_POST['map_id'], $_POST['description'])) {
		$result = array( 'result'=>'true');

	} else {
		$result = array( 'result'=>'false');
	}


	echo urldecode( json_encode ( $result ));
?>