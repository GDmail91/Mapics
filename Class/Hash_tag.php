<?
/////////////////////// CONTROLLER CLASS

 class Hash_tag {
 	// 태그 설정하기
 	function set_tag($tag_name, $map_id) { 
 		// db 연결
		$TagDB = new TagDB;
		// tag_name 저장
		//$TagDB->anti_sqlinjection();
		$TagDB->set_tag($tag_name, $map_id);
 	}

 	function get_tag($map_id) {
 		// db 연결
		$db = new TagDB;
		// tag_name 저장
		$db_result = $db->get_tag($map_id);
		

		// 불러온 태그 이름들을 JSON 형태로 저장
		$count = 1;
		$tag_result = "{";
		while (!empty($db_result)) {
			$tag = array_pop($db_result);
			$tag_result .= "\"".$count++."\" : \"".$tag['tag_name']."\"";

			if (!empty($db_result))
				$tag_result .=", ";
		}
		$tag_result .= "}";

		return $tag_result;
 	}
}


////////////////////// MODEL CALSS
include '_MapicsDB.php';

class TagDB extends _MapicsDB{
	function set_tag($tag_name, $map_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "INSERT INTO hash_tag (tag_name, map_id) VALUES ('".$tag_name."', '".$map_id."')";
		
		// 쿼리 실행
		if($result = mysql_query($sql, $connect)) {
			echo "DB insert success>";
		} else {
			echo "DB insert fail>";
		}

		return $result;
	}

	function get_tag($map_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "SELECT tag_name FROM hash_tag WHERE map_id=".$map_id;
		
		// 쿼리 실행
		$result = mysql_query($sql, $connect);

		// 쿼리 실행 결과를 배열 형태로 담음
		$resultArray = array ();  
		while ( $row = mysql_fetch_assoc($result)) {  
			$arrayMiddle = array (  
				"tag_name" => $row ['tag_name']
			);
			// $resultArray에 담기
			array_push($resultArray, $arrayMiddle);  
		}

		return $resultArray;
	}
}

?>