<?
	include '../Class/Img_ctl.php';

	$Img_ctl = new Img_ctl;

	// 저장 경로
	$file_path = '../Static/image/';
	
	// 저장 결과
	$upload_result = $Img_ctl->image_upload($file_path, $_POST['img_id']);

	/* map_upload 예제	
	// 저장 결과
	$upload_result = $Img_ctl->map_capture_upload($file_path, $_POST['map_id']);
	*/
	
	echo urldecode( json_encode ( $upload_result )) ;

?>