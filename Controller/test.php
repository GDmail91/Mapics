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
include '../Class/Hash_tag.php';

$hash_tag = new Hash_tag;
$array[10] = {1,2,3,4,5,6,7,8,9};
$test = array('map_id'=>$array);


echo urldecode( json_encode ( $array )) ;
?>