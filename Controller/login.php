<?
// CONTROLLER, MODEL 불러오기
include '../Class/Auth.php';

// 로그인
$auth = new Auth;
$result = $auth->login($_POST['email'], $_POST['password']);

/*
echo $sessid = $_SESSION['PHPSESSID'];
$url = "Location: http://localhost:8090/Mapics/Controller/test.php?sessid=".$sessid;
header($url);
exit;*/
//redirect('http://localhost:8090/Mapics/test.php?sessid='.$sessid);

echo urldecode( json_encode ( $result )) ;
?>