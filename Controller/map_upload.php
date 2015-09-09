<?
	include '../Class/Img_ctl.php';
	if ($_SESSION['is_login'] === true) {
		$Img_ctl = new Img_ctl;

		// 저장 경로
		$file_path = '../Static/map_capture/';
		
		if (empty($_POST['map_id'])) {
			$_POST['map_id'] = 1;
		}

		// 저장 결과
		$upload_result = $Img_ctl->map_capture_upload($file_path, $_POST['map_id']);
	} else {
		$result = array('result'=>'false', 'msg'=>'로그인이 필요합니다');
	}

	echo urldecode( json_encode ( $upload_result ));
?>