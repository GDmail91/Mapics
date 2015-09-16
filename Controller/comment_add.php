<?
include '../Class/Img_ctl.php';

	session_start();
	if ($_SESSION['is_login'] === true) {
		$img_ctl = new img_ctl;
		$img_ctl->anti_sqlinjection();
		$result = $img_ctl->addComment(0, $_POST['dest_id'], $_SESSION['user_id'], $_SESSION['nickname'], $_POST['comment']);
	} else {
		$result = array('result'=>'false', 'msg'=>'로그인이 필요합니다');
	}

	echo urldecode( json_encode ( $result ));
?>