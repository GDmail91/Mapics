<?
	include '../Class/mapLoad.php';

	session_start();

	if ($_SESSION['is_login'] === true) {
		$mapLoad = new mapLoad;
		
		if ($mapLoad->set_description($_POST['map_id'], $_POST['description'])) {
			$result = array( 'result'=>'true');

		} else {
			$result = array( 'result'=>'false');
		}
	} else {
		$result = array('result'=>'false', 'msg'=>'로그인이 필요합니다');
	}

	echo urldecode( json_encode ( $result ));
?>