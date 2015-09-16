<?
	include '../Class/mapLoad.php';
	include '../Class/Img_ctl.php';

	session_start();
	if ($_SESSION['is_login'] === true) {
		$mapLoad = new mapLoad;
		$Img_ctl = new Img_ctl;

		$result = $mapLoad->get_image($_POST['img_id'], $_SESSION['user_id']); // POST값으로 바꿀것		
		if ($Img_ctl->is_img_liker($_POST['img_id'], $_SESSION['user_id']))
			$is_like='ture';
		else 
			$is_like='false';
		$result += array('is_like' => $is_like);
		$comments = array('comments' => $Img_ctl->getComments($_POST['img_id'], 0)); // POST값으로 바꿀것
	} else {
		$result = array('result'=>'false', 'msg'=>'로그인이 필요합니다');
	}
	echo urldecode( json_encode ( $result + $comments ));
?>