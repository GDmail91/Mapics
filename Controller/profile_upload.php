<?
	include '../Class/Img_ctl.php';

	if ($_SESSION['is_login'] === true) {
		$Img_ctl = new Img_ctl;

		// 저장 경로
		$file_path = '../Static/profile/';
		
		// 저장 결과
		$upload_result = $Img_ctl->profile_upload($file_path, $_SESSION['user_id']);

		echo urldecode( json_encode ( $upload_result ));
	} else {
		$result = array('result'=>'false', 'msg'=>'로그인이 필요합니다');
	}
	
?>