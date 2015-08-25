<?
/////////////////////// CONTROLLER CLASS

 class Hash_tag {
 	// 태그 설정하기
 	function set_tag($tag_name, $map_id) { 
 		$has_tag_id = $this->get_tag_id($tag_name);
		// db 연결
		$TagDB = new TagDB;
		// tag_name 저장
		$TagDB->anti_sqlinjection();

 		// 태그네임이 이미 있는경우
 		if ($has_tag_id != null) {
			$db_result = $TagDB->link_tag($has_tag_id, $map_id);
			$result = array('result'=>$db_result);
		} else {
			$db_result = $TagDB->set_tag($tag_name, $map_id);
			$result = array('result'=>$db_result);
		}

		return $result;
 	}

 	function get_tag_id($tag_name) {
 		// db 연결
		$db = new TagDB;
		// tag_name 저장
		$db_result = $db->get_tag_by_name($tag_name);
	//	var_dump($db_result);
		return $db_result;
 	}

 	function get_map($tag_name) {
 		// db 연결
		$db = new TagDB;
		// tag_name 저장
		$db_result = $db->get_map_by_tag($tag_name);

		$result = array('map_id'=>$db_result);
		return $result;
 	}
}


////////////////////// MODEL CALSS
include_once '_MapicsDB.php';

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
		$sql = "INSERT INTO hash_tag (tag_name) VALUES ('".$tag_name."')";
		// 쿼리 실행
		$result = mysql_query($sql, $connect);

		$get_tag_id = $this->get_tag_by_name($tag_name);	

		$sql2 = "INSERT INTO map_link_hash (map_id, tag_id) VALUES ('".$map_id."', '".$get_tag_id."')";
		// 쿼리 실행
		$result2 = mysql_query($sql2, $connect);
		

		if ($result && $result2) 
			return true;
		else
			return false;
	}

	function link_tag($tag_id, $map_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "INSERT INTO map_link_hash (map_id, tag_id) VALUES ('".$map_id."', '".$tag_id."')";
		// 쿼리 실행
		$result = mysql_query($sql, $connect);
		
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

	function get_tag_by_name($tag_name) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "SELECT tag_id FROM hash_tag WHERE tag_name='".$tag_name."'";
		
		// 쿼리 실행
		$result = mysql_query($sql, $connect);

		// 쿼리 실행 결과
		$row = mysql_fetch_assoc($result);
		
		return $row['tag_id'];
	}

	function get_map_by_tag($tag_name) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		$tag_id = $this->get_tag_by_name($tag_name);
		// 쿼리문 생성
		$sql = "SELECT map_id FROM map_link_hash WHERE tag_id='".$tag_id."'";
		
		// 쿼리 실행
		$result = mysql_query($sql, $connect);
		
		// 쿼리 실행 결과를 배열 형태로 담음
		$resultArray = array ();  
		while ( $row = mysql_fetch_assoc($result)) {  
			// $resultArray에 담기
			array_push($resultArray, $row['map_id']);  
		}
//var_dump($resultArray);
		return $resultArray;
	}
}

?>