<?
	include '../Class/Auth.php';

	$Auth = new Auth;

	if (isset($_POST['user_id'])) 
		$user = $Auth->user_info($_POST['user_id']);
	else 
		$user = $Auth->user_info($_SESSION['user_id']);
	//var_dump(urlencode($user[0]['user_photo']));
	$result = array(
		'email'=>$user['email'],
		'phone'=>$user['phone'],
		'nickname'=>$user['nickname'],
		'career'=>$user['career'],
		'user_photo'=>$user['user_photo'],
		'follower'=>$user['follower'],
		'following'=>$user['following']
		);

	echo urldecode( json_encode ( $result )) ;

?>