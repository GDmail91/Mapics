<?
	include '../Class/Auth.php';
	session_start();

	if ($_SESSION['is_login'] === true) {
		$Auth = new Auth;
		$result = $Auth->edit_user(
			$_SESSION['user_id'],
			$_POST['nickname'], 
			$_POST['career'], 
			$_POST['email'], 
			$_POST['phone'], 
			$_POST['user_photo']
			);
	} else {
		$result = array('result'=>'false', 'msg'=>'로그인이 필요합니다');
	}

	echo urldecode( json_encode ( $result )) ;

?>