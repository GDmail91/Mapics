<?
	include '../Class/Img_ctl.php';
	include '../Class/mapLoad.php';

	$Img_ctl = new Img_ctl;
	$mapLoad = new mapLoad;
	
	if ($mapLoad->set_description($_POST['map_id'], $_POST['description'])) {
		// 저장 경로
		$file_path = '../Static/map_capture/';

		// 저장 결과
		$upload_result = $Img_ctl->map_capture_upload($file_path, $_POST['map_id']);
		
		if ($upload_result['result'] === 'true')
			$result = array( 'result'=>'true');
		else 
			$result = array( 'result'=>'false');

	} else {
		$result = array( 'result'=>'false');
	}


	echo urldecode( json_encode ( $result ));
?>