<?
	include '../Class/mapLoad.php';
	include '../Class/Auth.php';
	include '../Class/Hash_tag.php';
	include '../Class/Img_ctl.php';
	session_start();

	//if ($_SESSION['is_login']) {
		$mapLoad = new mapLoad;
		$userLoad = new Auth;
		$hash_tag = new Hash_tag;
		$Img_ctl = new Img_ctl;

		$mapArray = array();

		// POST로 온 tag_name 갯수 확인
		$tag_name = explode(' ', trim($_POST['tag_name']));

		$result_map_id = $hash_tag->get_map($_POST['tag_name']);

		// 각 맵ID 별로 가져옴
		foreach ($result_map_id as $map_id) {
			$map_info = $mapLoad->get_map_info($map_id);	// 맵정보
			$user_info = $userLoad->user_info($map_info['user_id']);	// 유저정보
			$tag = $hash_tag->get_tag_id_by_map($map_id);	// 태그 정보
			foreach ($tag as $tag_id) {
				$tag_name .= "#".$hash_tag->get_tag_name($tag_id)." ";	// 태그 네임 저장
			}

			if ($Img_ctl->is_img_liker($_POST['img_id'], $_SESSION['user_id']))
				$is_like='ture';
			else 
				$is_like='false';

			array_push($mapArray, array(
				'user_id'=>$map_info['user_id'],
				'nickname'=>$user_info['nickname'],
				'user_photo'=>$user_info['user_photo'],
				'map_id'=>$map_id, 
				'map_name'=>$map_info['map_name'],
				'map_capture'=>$map_info['map_capture'],
				'description'=>$map_info['description'],
				'liker'=>$map_info['liker'],
				'is_like'=>$is_like,
				'tag_name'=>$tag_name
				));
			$tag_name = "";
		}
	//} else {
	//	$mapArray = array('result'=>'false', 'msg'=>'로그인이 필요합니다');
	//}
	
	echo urldecode( json_encode ( $mapArray ));

?>