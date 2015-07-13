<?
/////////////////////// CONTROLLER CLASS

 class MapLoad {
 	// 맵 가져오기
	function getMap($map_id) {
		// db 연결
		$db = new ImgDB;
		// db에서 map_url 가져옴 (user_id, map_url, full_map)
		$map_result = $db->getMap($map_id);
		// db에서 사진들 가져옴
		$images = $db->getImages($map_id);

		$map = "{";
		$map .= "\"map_url\":\"".$map_result['map_url']."\",\"results\":[";
		// 이미지 관련 변수들 JSON 형태로 출력
		foreach ($images as $img) {
			$map .= "\"img_".$img['img_id']."\":[";
			$map .= "\"loc_x\":\"".$img['loc_x']."\", \"loc_y\":\"".$img['loc_y']."\"";
			$map .= ", \"img_url\":\"".$img['img_url']."\"";
			$map .= "]";

			if (!empty($img))
				$map .=",";
		}
		$map .= "]}";
		return $map;
	}

	// 맵 이미지 불러오기
	function getMapImg() {
		$mapImg;
		return $mapImg;
	}

	// 맵에 이미지 넣기
	function imgUpload($file, $map_id, $loc_x, $loc_y) { // 필요하다면 post 변수를 인자로 전달받아 사용
		$file_path = $_SERVER['DOCUMENT_ROOT']."/AndroTest/appimg/";
		$file_path .= basename( $_FILES['uploaded_file']['name']);
		
		if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
			echo "<File upload success>";
		} else{
			echo "<File upload fail>";
		}

		// db 연결 사진들 가져옴
		$db = new ImgDB;
		$result = $db->setImage(
			$_FILES['uploaded_file']['name'], 
			$_POST['map_id'], 
			$_POST['loc_x'], 
			$_POST['loc_y']
			);

		echo $result;
	}
}


////////////////////// MODEL CALSS

class ImgDB {
	var $db_host = "128.199.102.18";   
	var $db_id = "mapics_admin";  
	var $db_password = "mapics2015";  
	var $db_dbname = "post_at"; 

	// 전체 사진 가져오기
	function getImages($map_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "SELECT img_id, map_id, loc_x, loc_y, img_url FROM image_storage WHERE map_id =".$map_id;
		// 쿼리 실행
		$result = mysql_query($sql, $connect);

		// 쿼리 실행 결과를 배열 형태로 담음
		$resultArray = array ();  
		while ( $row = mysql_fetch_assoc($result)) {  
			$arrayMiddle = array (  
				"img_id" => (int) $row ['img_id'] ,  
				"loc_x" => (int) $row ['loc_x'] ,  
				"loc_y" => (int) $row ['loc_y'],
				"img_url" => $row ['img_url']
			);
			// $resultArray에 담기
			array_push($resultArray, $arrayMiddle);  
		}

		return $resultArray;
	}

	function getMap($map_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "SELECT user_id, map_url, full_map FROM map_storage WHERE map_id =".$map_id;
		// 쿼리 실행
		$result = mysql_query($sql, $connect);
		// 쿼리 실행 결과
		$row = mysql_fetch_assoc($result);
		
		// $resultArray에 담기
		$resultArray = array (  
			"user_id" => (int) $row ['user_id'] ,  
			"map_url" => $row ['map_url'] ,  
			"full_map" => $row ['full_map']
		);
		return $resultArray;
	}

	// 사진 올리기 
	function setImage($img_url, $map_id, $loc_x, $loc_y) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "INSERT INTO image_storage (map_id, loc_x, loc_y, img_url) VALUES ('".$map_id."', '".$loc_x."', '".$loc_y."', '".$img_url."')";
		// 쿼리 실행
		if($result = mysql_query($sql, $connect)) {
			echo "<DB insert success>";
		} else {
			echo "<DB insert fail>";
		}

		return $result;
	}
}

?>