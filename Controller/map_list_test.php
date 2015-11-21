<?
	include '../Class/mapLoad.php';
	include '../Class/Auth.php';
	include '../Class/Hash_tag.php';
	include '../Class/Img_ctl.php';

	$mapLoad = new mapLoad;
	$auth = new Auth;
	$hash_tag = new Hash_tag;
	$Img_ctl = new Img_ctl;
	
	// num 값이 있는 경우 num값 만큼만 가져옴 (기본값 5)
	if (isset($_POST['num'])) {
		$maps = $mapLoad->getMapFeedCapture($_POST['user_id'], $_POST['num']);
	} else {
		$maps = $mapLoad->getMapFeedCapture($_POST['user_id']);
	}


	$map_list[] = null ; // 결과 담을 변수
	foreach ($maps as $map) {
		$user_info =  $auth->user_info($map['user_id']); // 각 맵의 사용자 정보 가져옴

		$tag = $hash_tag->get_tag_id_by_map($map['map_id']);	// 태그 정보
		foreach ($tag as $tag_id) {
			$tag_name .= "#".$hash_tag->get_tag_name($tag_id)." ";	// 태그 네임 저장
		}

		if ($Img_ctl->is_map_liker($map['map_id'], $_SESSION['user_id']))
			$is_like='true';
		else 
			$is_like='false';

		array_push($map_list, $map+array(
			'is_like'=>$is_like,
			'nickname'=>$user_info['nickname'], // 사용자 정보에서 nickname 값 가져옴
			'tag_name'=>$tag_name)); // tag 이름 가져옴
		$tag_name = null;
	}
$mapArray[] = null;
	for ($i=0; $i < count($maps); $i++) { 
		$mapArray['mapInfo'.$i] = $map_list[$i+1]; // 각 맵정보를 배열에 담음
	}
	echo(urldecode( json_encode ( $mapArray ))) ;

?>