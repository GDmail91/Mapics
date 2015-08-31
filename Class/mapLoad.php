<?
/////////////////////// CONTROLLER CLASS

 class MapLoad {
 	// 맵 가져오기
	function getMap($map_id) {
		// db 연결
		$db = new ImgDB;
		// db에서 map_url 가져옴 (user_id, map_url, map_capture)
		$map_result = $db->getMap($map_id);
		// db에서 사진들 가져옴
		$img = $db->getImages($map_id);

		$map = array(
			'map_url'=>$map_result['map_url'],  // 지도 배경
			'results'=>$img
			);
		return $map;
	}

	// 맵 하나 정보 가져오기
	function get_map_info($map_id) {
		// db 연결
		$db = new ImgDB;
		// db에서 map_url 가져옴 (user_id, map_url, map_capture)
		$map_result = $db->getMap($map_id);
		
		return $map_result;
	}

	// 맵 캡쳐 불러오기
	function getMapCapture($map_id) {
		// db 연결
		$db = new ImgDB;
		// db에서 map_url 가져옴 (user_id, map_url, full_map)
		$map_result = $db->getMap($map_id);

		return $map_result;
		//$mapImg = $map_result['map_capture'];

		//return $mapImg;
	}

	// 맵 캡쳐 전체($num 개수만큼) 불러오기
	function getMapAllCapture($num = 30) {
		// db 연결
		$db = new ImgDB;
		// db에서 map_url 가져옴 (map_url, full_map, description, liker)
		$map_result = $db->getMapAll($num);

		return $map_result;
	}

	// 맵 캡처 아이디로 불러오기
	function getMapCaptureById($user_id, $num = 5) {
		// db 연결
		$db = new ImgDB;
		
		// db에서 map_url 가져옴 (map_url, full_map, description, liker)
		$map_result = $db->getMapById($user_id, $num);

		return $map_result;
	}

	// 사진 한장에 대한 정보 불러오기
	function getImage($img_id) {
		// db 연결
		$db = new ImgDB;
		// db에서 사진에 대한 정보 가져옴
		$img = $db->getEachImage($img_id);

		return $img;
	}

	function set_description($map_id, $description) {
		// db 연결
		$db = new ImgDB;
		
		// db 실행
		$map_result = $db->set_description($map_id, $description);

		return $map_result;
	}

	// 맵 업로드
	function upload_Map($map_info) {
		// db 연결
		$db = new ImgDB;
		// db에서 map_url 가져옴 (user_id, map_url, full_map)
		$db->anti_sqlinjection();
		$map_result = $db->regMap($map_info);

		return $map_result;
	}

	// 맵에 이미지 넣기
	function imgUpload($file_path, $map_id, $loc_x, $loc_y, $description) { // 필요하다면 post 변수를 인자로 전달받아 사용
		$file_path = $_SERVER['DOCUMENT_ROOT']."/Mapics/appimg/";
		$file_path .= basename( $_FILES['uploaded_file']['name']);
		
		if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
			echo "<File upload success>";
		} else{
			echo "<File upload fail>";
		}

		// 사진들 가져와 db에 넣음
		$db = new ImgDB;
		$result = $db->setImage(
			$_FILES['uploaded_file']['name'], 
			$_POST['map_id'], 
			$_POST['loc_x'], 
			$_POST['loc_y'],
			$_POST['description']
			);

		echo $result;
	}

	// 캡처된 맵  넣기
	function mapUpload($file, $map_id) { // 필요하다면 post 변수를 인자로 전달받아 사용
		$file_path = $_SERVER['DOCUMENT_ROOT']."/Mapics/Static/map_capture";
		$file_path .= basename( $_FILES['uploaded_file']['name']);
		
		if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
			echo "<File upload success>";
		} else{
			echo "<File upload fail>";
		}

		// 사진들 가져와 db에 넣음
		$db = new ImgDB;
		$result = $db->setImage(
			$_FILES['uploaded_file']['name'], 
			$_POST['map_id']
			);

		echo $result;
	}

}


////////////////////// MODEL CALSS
include_once '_MapicsDB.php';

class ImgDB extends _MapicsDB{

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
		$sql = "SELECT img_id, map_id, loc_x, loc_y, img_url, description, liker FROM image_storage WHERE map_id =".$map_id;
		// 쿼리 실행
		$result = mysql_query($sql, $connect);

		// 쿼리 실행 결과를 배열 형태로 담음
		$resultArray = array ();  
		while ( $row = mysql_fetch_assoc($result)) {  
			$arrayMiddle = array (  
				"img_id" => (int) $row ['img_id'] ,  
				"loc_x" => (int) $row ['loc_x'] ,  
				"loc_y" => (int) $row ['loc_y'],
				"img_url" => $row ['img_url'],
				"description" => $row['description'],
				"liker" => (int) $row ['liker']
			);
			// $resultArray에 담기
			array_push($resultArray, $arrayMiddle);  
		}

		return $resultArray;
	}

	// 사진 하나 가져오기
	function getEachImage($img_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "SELECT loc_x, loc_y, img_url, description, liker FROM image_storage WHERE img_id =".$img_id;
		// 쿼리 실행
		$result = mysql_query($sql, $connect);

		// 쿼리 실행 결과
		$row = mysql_fetch_assoc($result);
		
		// $resultArray에 담기
		$resultArray = array (  
			"loc_x" => (int) $row ['loc_x'] ,  
			"loc_y" => (int) $row ['loc_y'],
			"img_url" => $row ['img_url'],
			"description" => $row['description'],
			"liker" => (int) $row ['liker']
		);
		return $resultArray;
	}

	// 맵 하나 가져오기
	function getMap($map_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "SELECT user_id, map_name, full_map, description, liker FROM map_storage WHERE map_id =".$map_id;
		// 쿼리 실행
		$result = mysql_query($sql, $connect);
		// 쿼리 실행 결과
		$row = mysql_fetch_assoc($result);
		
		// $resultArray에 담기
		$resultArray = array (  
			"map_id" => $map_id,
			"user_id" => (int) $row ['user_id'] ,  
			"map_name" => $row ['map_name'] ,  
			"map_capture" => $row ['full_map'],
			"description" => $row['description'],
			"liker" => (int) $row ['liker']
		);
		return $resultArray;
	}

	// 맵 전부 가져오기
	function getMapAll($num) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "SELECT map_id, user_id, full_map, description, liker FROM map_storage ORDER BY edit_date DESC LIMIT ".$num  ;
		// 쿼리 실행
		$result = mysql_query($sql, $connect);
		
		// 쿼리 실행 결과를 배열 형태로 담음
		$resultArray = array ();  
		while ( $row = mysql_fetch_assoc($result)) {  
			$arrayMiddle = array (  
				"map_id" => (int) $row ['map_id'] ,
				"user_id" => (int) $row ['user_id'],
				"map_capture" => $row ['full_map'],
				"description" => $row ['description'],
				"liker" => $row ['liker']
			);
			// $resultArray에 담기
			array_push($resultArray, $arrayMiddle);  
		}

		return $resultArray;
	}

	// 유저 아이디에 해당하는 거 전부 가져오기
	function getMapById($user_id, $num) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "SELECT map_id, user_id, full_map, description, liker FROM map_storage WHERE user_id = ".$user_id." LIMIT ".$num ;
		// 쿼리 실행
		$result = mysql_query($sql, $connect);
		
		// 쿼리 실행 결과를 배열 형태로 담음
		$resultArray = array ();  
		while ( $row = mysql_fetch_assoc($result)) {  
			$arrayMiddle = array (  
				"map_id" => (int) $row ['map_id'] ,
				"user_id" => (int) $row ['user_id'],
				"map_capture" => $row ['full_map'],
				"description" => $row ['description'],
				"liker" => $row ['liker']
			);
			// $resultArray에 담기
			array_push($resultArray, $arrayMiddle);  
		}

		return $resultArray;
	}

	function set_description($map_id, $description) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "UPDATE map_storage SET description = '".$description."', edit_date = CURRENT_TIMESTAMP() WHERE map_id = '".$map_id."'";
		// 쿼리 실행
		$result = mysql_query($sql, $connect);

		return $result;
	}

	// 사진 올리기 
	function setImage($img_url, $map_id, $loc_x, $loc_y, $description) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "INSERT INTO image_storage (map_id, loc_x, loc_y, img_url, description) VALUES ('".$map_id."', '".$loc_x."', '".$loc_y."', '".$img_url.", '".$description."')";
		// 쿼리 실행
		if($result = mysql_query($sql, $connect)) {
			echo "<DB insert success>";
			$update_sql = "UPDATE 'map_storage' SET 'edit_date' = CURRENT_TIMESTAMP()";
			mysql_query($update_sql, $connent);
		} else {
			echo "<DB insert fail>";
		}

		return $result;
	}

	// 맵 캡처 올리기 
	function setMapCapture($full_map, $map_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "UPDATE 'map_storage' SET 'map_id' = '".$map_id."', 'full_map' = '".$full_map."', 'edit_date'=CURRENT_TIMESTAMP())";
		// 쿼리 실행
		$result = mysql_query($sql, $connect);

		/*if($result = mysql_query($sql, $connect)) {
			echo "<DB insert success>";
		} else {
			echo "<DB insert fail>";
		}*/

		return $result;
	}

	function regMap($map_info) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		$cur_map_sql = "SELECT map_id FROM map_storage ORDER BY map_id DESC LIMIT 1";
		$cur_map_result = mysql_query($cur_map_sql, $connect);
		$cur_map_id = mysql_fetch_assoc($cur_map_result);
		$cur_map_id['map_id'] += 1;

		// 쿼리문 생성
		$sql = "INSERT INTO map_storage (map_id, user_id, map_name, map_locate, map_type ) VALUES ('".$cur_map_id['map_id']."', '".$map_info['user_id']."', '".$map_info['map_name']."', '".$map_info['map_locate']."', '".$map_info['map_type']."')";
		// 쿼리 실행

		$db_result = mysql_query($sql, $connect);

		$result = array('db_result'=>$db_result, 'map_id'=>$cur_map_id['map_id']);
		return $result;
	}
}

?>