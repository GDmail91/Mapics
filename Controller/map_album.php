<?
	include '../Class/mapLoad.php';
	include '../Class/Img_ctl.php';
	
	session_start();
	if ($_SESSION['is_login'] === true) {
		$mapLoad = new mapLoad;
		$Img_ctl = new Img_ctl;

		$map_album = $mapLoad->getMap($_POST['map_id']);

		if ($Img_ctl->is_img_liker($_POST['img_id'], $_SESSION['user_id']))
			$is_like='ture';
		else 
			$is_like='false';
		$map_album += array('is_like'=>$is_like);
	} else {
		$map_album = array('result'=>'false', 'msg'=>'로그인이 필요합니다');
	}


	echo urldecode( json_encode ( $map_album )) ;

?>