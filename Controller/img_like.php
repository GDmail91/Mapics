<?
	include '../Class/Img_ctl.php';
	

	session_start();

	if ($_SESSION['is_login'] === true) {
		$img_ctl = new Img_ctl;

		// 좋아요가 안되있을 경우
		if ($img_ctl->is_img_liker($_POST['img_id'], $_SESSION['user_id']) === false) {
			$liker = $img_ctl->img_like($_POST['img_id'], $_SESSION['user_id']);
			
			if (is_int($liker)) {
				$result = array(
					'result'=>'true',
					'liker'=>$liker
					);
			} else {
				$result = array( 'result'=>'false', 'msg'=>'좋아요 실패' );
			}
		// 좋아요가 되어있을 경우
		} else {
			$liker = $img_ctl->img_dislike($_POST['img_id'], $_SESSION['user_id']);

			if (is_int($liker)) {
				$result = array(
					'result'=>'true',
					'liker'=>$liker
					);
			} else {
				$result = array( 'result'=>'false', 'msg'=>'좋아요 취소 실패' );	
			}
		}
	} else {
		$result = array('result'=>'false', 'msg'=>'로그인이 필요합니다.');
	}
	
	echo urldecode( json_encode ( $result )) ;

?>