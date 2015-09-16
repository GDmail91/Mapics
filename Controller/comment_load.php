<?
	include '../Class/Img_ctl.php';
	include '../Class/Auth.php';

	session_start();
	if ($_SESSION['is_login'] === true) {
		$Img_ctl = new Img_ctl;
		$Auth = new Auth;

		$comments = $Img_ctl->getComments($_POST['dest_id'], 0);

		$co_result = array();
		foreach ($comments as $comment) {
			$user_info = $Auth->user_info($comment['user_id']);
			$profile_img = array( 'user_photo'=>$user_info['user_photo']);
			array_push($co_result, $comment + $profile_img);
		}

		$result = array('result'=>'true', 'comments' => $co_result); 
		
	} else {
		$result = array('result'=>'false', 'msg'=>'로그인이 필요합니다');
	}
	echo urldecode( json_encode ( $result ));
?>

