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
$tag = $hash_tag->get_tag_id_by_map($_POST['map_id']);
foreach ($tag as $tag_id) {
	echo $tag_name = $hash_tag->get_tag_name($tag_id)." ";
}

//echo urldecode( json_encode ( $array )) ;
?>