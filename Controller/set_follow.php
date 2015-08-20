<?
	include '../Class/Auth.php';

	$Auth = new Auth;

	$result = $Auth->set_follow($_POST['user_id'], $_POST['dest_id']);

	echo urldecode( json_encode ( $result )) ;

?>