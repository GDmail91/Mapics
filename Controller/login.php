<?
// CONTROLLER, MODEL 불러오기
include '../Class/Auth.php';

if ($_SESSION['is_login'] == true) {
	$result = array("result"=>'true');
} else {
	// 로그인
	$auth = new Auth;
	$result = $auth->login($_POST['email'], $_POST['password']);
}

echo urldecode( json_encode ( $result )) ;
?>