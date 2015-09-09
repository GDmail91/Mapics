<?
	include '../Class/Auth.php';

	$Auth = new Auth;

	if (isset($_POST['user_id'])) 
		$user = $Auth->user_info($_POST['user_id']);
	else 
		$user = $Auth->user_info($_SESSION['user_id']);
	//var_dump(urlencode($user[0]['user_photo']));
	$result = array(
		'email'=>$user[0]['email'],
		'phone'=>$user[0]['phone'],
		'nickname'=>$user[0]['nickname'],
		'career'=>$user[0]['career'],
		'user_photo'=>$user[0]['user_photo'],
		'follower'=>$user[1]['follower'],
		'following'=>$user[1]['following']
		);

	echo urldecode( json_encode ( $result )) ;

?>