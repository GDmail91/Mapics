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

	include '../Class/Auth.php';
	session_start();
	
	$Auth = new Auth;

	if (!empty($_POST['user_id'])) 
		$user = $Auth->user_info($_POST['user_id']);
	else 
		$user = $Auth->user_info($_SESSION['user_id']);
	//var_dump(urlencode($user[0]['user_photo']));

	if (!empty($user)) {
		$result = array(
			'email'=>$user['email'],
			'phone'=>$user['phone'],
			'nickname'=>$user['nickname'],
			'career'=>$user['career'],
			'user_photo'=>$user['user_photo'],
			'follower'=>$user['follower'],
			'following'=>$user['following']
			);
	} else {
		$result = array('result'=>'false');
	}

	if (!empty($_POST['user_id'])) 
		$follow_result = $Auth->get_follow($_POST['user_id']);
	else 
		$follow_result = $Auth->get_follow($_SESSION['user_id']);
	

	$follow_list = array();
	foreach ($follow_result as $user_id) {
		$user_info = $Auth->user_info($user_id);
		// 나중에 세션 데이터를 사용 user_id를 $_SESSION['user_id'] 를 사용한다.
		//$is_follow = $Auth->is_follow($my_id, $user_id);
		
		array_push($follow_list, array(
				'user_id'=>$user_id,
				'nickname'=>$user_info['nickname'],
				'user_photo'=>$user_info['user_photo'],
				// 여기도 변경
				'is_follow'=>'true'
			));
	}
	
	echo urldecode( json_encode ( $result )) ;
	echo "<br>";
	echo urldecode( json_encode ( $follow_list )) ;

?>