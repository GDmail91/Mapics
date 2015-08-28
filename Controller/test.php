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
//echo $_SESSION['nickname']." ".$_SESSION['user_id']." ".$_SESSION['is_login'];

$array = array(
	'nickname'=>$_SESSION['nickname'],
	'user_id'=>$_SESSION['user_id'],
	'is_login'=>$_SESSION['is_login']
	);
echo urldecode( json_encode ( $array )) ;

//echo urldecode( json_encode ( $array )) ;
?>