<?
	include '../Class/Img_ctl.php';

	$Img_ctl = new Img_ctl;

	// 저장 경로
	$file_path = '../Static/image/';
	
	if (empty($_POST['img_id'])) {
		$_POST['img_id'] = 1;
	}
	// 저장 결과
	$upload_result = $Img_ctl->image_upload($file_path, $_POST['img_id']);
	
	echo urldecode( json_encode ( $upload_result )) ;

?>