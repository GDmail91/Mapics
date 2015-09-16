<?
	include '../Class/mapLoad.php';
	include '../Class/Hash_tag.php';
	include '../Class/Img_ctl.php';

	session_start();
	if ($_SESSION['is_login'] === true) {
		$mapReg = new mapLoad;

		$reg_result = $mapReg->upload_img(array(
			'map_id'=>$_POST['map_id'], 
			'loc_x'=>$_POST['loc_x'], 
			'loc_y'=>$_POST['loc_y'],
			'place_id'=>$_POST['place_id'],
			'description'=>$_POST['description']
			)
		);
		/*
		// 사진에는 해쉬태그 불필요?
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
			$hash_result = false;
		}
		*/

		$Img_ctl = new Img_ctl;

		// 저장 경로
		$file_path = '../Static/image/';
		// 저장 결과
		$upload_result = $Img_ctl->image_upload($file_path, $reg_result['img_id']);

		// 결과가 모두 성공일 경우
		if ($reg_result['db_result'] && $upload_result) {
			$result = array('result'=>'true', 'img_id'=>(string)$reg_result['img_id']);
		} else {
			$result = array('result'=>'false', 'msg'=>'업로드 실패');
		}
	} else {
		$result = array('result'=>'false', 'msg'=>'로그인이 필요합니다');
	}
	

	echo urldecode( json_encode ( $result )) ;

?>