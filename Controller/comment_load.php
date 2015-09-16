<?
	include '../Class/Img_ctl.php';

	session_start();
	if ($_SESSION['is_login'] === true) {
		$Img_ctl = new Img_ctl;

		$result = array('result'=>'true', 'comments' => $Img_ctl->getComments($_POST['img_id'], 0)); 
		
	} else {
		$result = array('result'=>'false', 'msg'=>'로그인이 필요합니다');
	}
	echo urldecode( json_encode ( $result ));
?>

