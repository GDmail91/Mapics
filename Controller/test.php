<?
/*// CONTROLLER, MODEL 불러오기
include '../Class/Auth.php';

// 회원가입
$auth = new Auth;
$auth->login();

$_SESSION['test'] = '테스트';
$_SESSION['test2'] = '테스트2';
$_SESSION['test3'] = '테스트3';
var_dump($_SESSION);
session_start('tesT!!!');
//session_destroy($name);

echo $_COOKIE['PHPSESSID'];

echo "<br>";
if ($_COOKIE['PHPSESSID'] === session_id()) {
	echo TRUE;
}*/



session_start();

function Get($param,$default=null) {
 return isset( $_GET[$param]) ? 
 	$_GET[$param] : (isset($_POST[$param]) ? 
 		$_POST[$param] : $default);
}

// 세션에 auth_user가 있는경우
if ($_SESSION['auth_user'] == 'test') {
	echo "already login";
}
// 또는 Get이나 Post로 데이터가 온경우
else if(Get('id')=='test'&&Get('pwd')=='test') {
	$_SESSION['auth_user'] = 'test';
	echo "login success";
} 
// 아무것도 없는경우
else {
	echo "please login";
}

?>