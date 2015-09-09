<?
	include '../Class/Auth.php';

	$Auth = new Auth;

	$follow_result = $Auth->get_follow($_POST['user_id']);

	$follow_list = array();
	foreach ($follow_result as $user_id) {
		$user_info = $Auth->user_info($user_id);
		// 나중에 세션 데이터를 사용 user_id를 $_SSESION['user_id'] 를 사용한다.
		//$is_follow = $Auth->is_follow($my_id, $user_id);
		
		array_push($follow_list, array(
				'user_id'=>$user_id,
				'nickname'=>$user_info['nickname'],
				'user_photo'=>$user_info['user_photo'],
				// 여기도 변경
				'is_follow'=>'true'
			));
	}


	echo urldecode( json_encode ( $follow_list )) ;

?>