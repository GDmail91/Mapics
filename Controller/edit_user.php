<?
	include '../Class/Auth.php';

	$Auth = new Auth;

	$result = $Auth->edit_user($_GET['user_id']);

	echo $result ;

?>