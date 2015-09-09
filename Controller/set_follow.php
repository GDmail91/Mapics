<?
	include '../Class/Auth.php';

	if ($_SESSION['is_login'] === true) {
		$Auth = new Auth;

		$result = $Auth->set_follow($_SESSION['user_id'], $_POST['dest_id']);

	} else {
		$result = array('result'=>'false', 'msg'=>'로그인이 필요합니다');
	}
	
	echo urldecode( json_encode ( $result )) ;

?>