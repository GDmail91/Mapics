<?
	include '../Class/mapLoad.php';
	include '../Class/Auth.php';
	include '../Class/Hash_tag.php';
	include '../Class/Img_ctl.php';
	
	session_start();

	if ($_SESSION['is_login']) {
		$mapLoad = new mapLoad;
		$auth = new Auth;
		$hash_tag = new Hash_tag;
		$Img_ctl = new Img_ctl;

		$map = $mapLoad->get_map_info($_POST['map_id']);

		//var_dump($map);
		$user_info =  $auth->user_info($map['user_id']); // 맵의 사용자 정보 가져옴

		$tag = $hash_tag->get_tag_id_by_map($map['map_id']);	// 태그 정보
		foreach ($tag as $tag_id) {
			$tag_name .= "#".$hash_tag->get_tag_name($tag_id)." ";	// 태그 네임 저장
		}

		if ($Img_ctl->is_img_liker($_POST['img_id'], $_SESSION['user_id']))
			$is_like='ture';
		else 
			$is_like='false';

		$map_info = $map+array(
			'is_like'=>$is_like,
			'nickname'=>$user_info['nickname'], // 사용자 정보에서 nickname 값 가져옴
			'tag_name'=>$tag_name); // tag 이름 가져옴
	} else {
		$map_info = array('result'=>'false', 'msg'=>'로그인이 필요합니다');
	}

	echo urldecode( json_encode ( $map_info ));

?>