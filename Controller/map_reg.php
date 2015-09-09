<?
	include '../Class/mapLoad.php';
	include '../Class/Hash_tag.php';

	if ($_SESSION['is_login'] === true) {
		$mapReg = new mapLoad;

		$reg_result = $mapReg->upload_map(array(
			'user_id'=>$_POST['user_id'], 
			'map_name'=>$_POST['map_name'], 
			'map_locate'=>$_POST['map_locate'],
			'map_type'=>$_POST['map_type']
			)
		);

		// tag_name과 맵을 넣은 결과값이 true일 경우만
		if (!empty($_POST['tag_name']) && $reg_result['db_result']) {
			// POST 로 온 map_id 에 해당하는 태그들 DB에 넣음
			// 해시태그 갯수만큼 불러와야함 (추후에 배열로 받는걸로 바꿔야함)
			$hash_tag = new Hash_tag;
			$tag = explode(" ", trim($_POST['tag_name']));
			foreach ($tag as $tag_name) {
				$hash_result = $hash_tag->set_tag($tag_name, $reg_result['map_id']);	
				if (!$hash_result) 
					break;
			}
		} else {
			$hash_result = true;
		}

		if ($reg_result['db_result'] && $hash_result) {
			$result = array('result'=>'true', 'map_id'=>(string)$reg_result['map_id']);
		} else {
			$result = array('result'=>'false');
		}
	} else {
		$result = array('result'=>'false', 'msg'=>'로그인이 필요합니다');
	}
	
	echo urldecode( json_encode ( $result )) ;

?>