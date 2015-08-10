<?
// CONTROLLER, MODEL 불러오기
include '../Class/Auth.php';

// 회원가입
$auth = new Auth;
$auth->register($_POST['name'], $_POST['password'], $_POST['re_password'], $_POST['phone'], $_POST['email']);

?>