<?
// CONTROLLER, MODEL 불러오기
include '../Class/Auth.php';

// 로그인
$auth = new Auth;
$result = $auth->login($_POST['email'], $_POST['password']);


//echo $_SESSION['nickname']." ".$_SESSION['user_id']." ".$_SESSION['is_login'];

echo urldecode( json_encode ( $result )) ;
?>