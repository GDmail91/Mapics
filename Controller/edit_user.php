<?
	include '../Class/Auth.php';

	$Auth = new Auth;

	$result = $Auth->edit_user(
		$_POST['user_id'],
		$_POST['nickname'], 
		$_POST['career'], 
		$_POST['email'], 
		$_POST['phone'], 
		$_POST['user_photo']
		);

	echo $result ;

?>