<?
	include '../Class/Auth.php';

	$Auth = new Auth;

	$user = $Auth->user_info($_POST['user_id']);

	echo urldecode( json_encode ( $user )) ;

?>