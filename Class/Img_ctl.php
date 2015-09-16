<?

////////////////////// MODEL CALSS
include_once '_MapicsDB.php';
include_once 'password.php';

class Img_ctl extends _MapicsDB{
	// 사진 좋아요 클릭 
	function img_like($img_id, $user_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "UPDATE image_storage SET liker = liker+1 WHERE img_id = ".$img_id;
		// 좋아요 쿼리 실행
		$result = mysql_query($sql, $connect);

		// 쿼리문 생성
		$sql2 = "INSERT INTO img_like_table (img_id, user_id) VALUES ('".$img_id."', '".$user_id."')";
		// 좋아요 등록
		$result = mysql_query($sql2, $connect);
		
		// 업데이트 된 값 전달
		$sql3 = "SELECT liker FROM image_storage WHERE img_id=".$img_id;
		$result = mysql_query($sql3, $connect);
		// 쿼리 실행 결과
		$row = mysql_fetch_assoc($result);
		
		return (int)$row['liker'];
	}

	// 사진 좋아요 되있는지 확인
	function is_img_liker($img_id, $user_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();
		
		// 쿼리문 생성
		$sql = "SELECT COUNT(user_id) AS is_like FROM img_like_table WHERE img_id=".$img_id." AND user_id=".$user_id;
		$result = mysql_query($sql, $connect);
		// 쿼리 실행 결과
		$row = mysql_fetch_assoc($result);
		$is_like = (int)$row['is_like'];
		
		if ($is_like > 0) {
			$db_result = true;
		} else {
			$db_result = false;
		}

		return $db_result;
	}

	// 지도 좋아요 클릭 
	function Map_like($map_id, $user_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "UPDATE map_storage SET liker = liker+1 WHERE map_id = ".$map_id;
		// 좋아요 쿼리 실행
		$result = mysql_query($sql, $connect);

		// 쿼리문 생성
		$sql2 = "INSERT INTO map_like_table (map_id, user_id) VALUES ('".$map_id."', '".$user_id."')";
		// 좋아요 등록
		$result = mysql_query($sql2, $connect);
		
		// 업데이트 된 값 전달
		$sql3 = "SELECT liker FROM map_storage WHERE map_id=".$map_id;
		$result = mysql_query($sql3, $connect);
		// 쿼리 실행 결과
		$row = mysql_fetch_assoc($result);
		
		return (int)$row['liker'];
	}

	// 지도 좋아요 되있는지 확인
	function is_map_liker($map_id, $user_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();
		
		// 쿼리문 생성
		$sql = "SELECT COUNT(user_id) AS is_like FROM map_like_table WHERE map_id=".$map_id." AND user_id=".$user_id;
		$result = mysql_query($sql, $connect);
		// 쿼리 실행 결과
		$row = mysql_fetch_assoc($result);
		$is_like = (int)$row['is_like'];
		
		if ($is_like > 0) {
			$db_result = true;
		} else {
			$db_result = false;
		}

		return $db_result;
	}

	// 사진 좋아요 취소 클릭 
	function img_dislike($img_id, $user_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "UPDATE image_storage SET liker = liker-1 WHERE img_id = ".$img_id;
		// 좋아요 쿼리 실행
		$result = mysql_query($sql, $connect);

		// 쿼리문 생성
		$sql2 = "DELETE FROM img_like_table WHERE img_id=".$img_id." AND user_id =".$user_id;
		// 좋아요 취소 등록
		$result = mysql_query($sql2, $connect);
		
		// 업데이트 된 값 전달
		$sql3 = "SELECT liker FROM image_storage WHERE img_id=".$img_id;
		$result = mysql_query($sql3, $connect);
		// 쿼리 실행 결과
		$row = mysql_fetch_assoc($result);
		
		return (int)$row['liker'];
	}

	// 지도 좋아요 취소 클릭 
	function Map_dislike($map_id, $user_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "UPDATE map_storage SET liker = liker-1 WHERE map_id = ".$map_id;
		// 좋아요 쿼리 실행
		$result = mysql_query($sql, $connect);

		// 쿼리문 생성
		$sql2 = "DELETE FROM map_like_table WHERE map_id=".$map_id." AND user_id =".$user_id;
		// 좋아요 취소 등록
		$result = mysql_query($sql2, $connect);
		
		// 업데이트 된 값 전달
		$sql2 = "SELECT liker FROM map_storage WHERE map_id=".$map_id;
		$result = mysql_query($sql2, $connect);
		// 쿼리 실행 결과
		$row = mysql_fetch_assoc($result);
		
		return (int)$row['liker'];
	}

	// 사진 좋아요 수 가져오기
	function get_img_like($img_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "SELECT liker FROM image_storage WHERE img_id=".$img_id;
		// 쿼리 실행
		$result = mysql_query($sql, $connect);
		// 쿼리 실행 결과
		$row = mysql_fetch_assoc($result);
		
		return (int)$row['liker'];
	}

	// 지도 좋아요 수 가져오기
	function get_map_like($map_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "SELECT liker FROM map_storage WHERE map_id=".$map_id;
		// 쿼리 실행
		$result = mysql_query($sql, $connect);
		// 쿼리 실행 결과
		$row = mysql_fetch_assoc($result);
		
		return (int)$row['liker'];
	}

	// 사진 댓글 가져오기 (category : 0)
	function getComments($dest_id, $category=0){ // 사진 id, 카테고리
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "SELECT co_id, user_id, nickname, comment, postdate FROM comments WHERE dest_id=".$dest_id." AND category=".$category;

		// 쿼리 실행
		$result = mysql_query($sql, $connect);

		// 쿼리 실행 결과를 배열 형태로 담음
		$resultArray = array ();  
		while ( $row = mysql_fetch_assoc($result)) {  
			$arrayMiddle = array (  
				"co_id" => (int) $row ['co_id'] ,  
				"user_id" => (int) $row ['user_id'] ,  
				"nickname" => $row ['nickname'],
				"comment" => $row ['comment'],
				"postdate" => $row['postdate']
			);
			// $resultArray에 담기
			array_push($resultArray, $arrayMiddle);  
		}

		return $resultArray;
	}

	// 사진 댓글 작성 (category : 0)
	function addComment($category, $dest_id, $user_id, $nickname, $comment) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "INSERT INTO comments (category, dest_id, user_id, comment, nickname) VALUES ('".$category."', '".$dest_id."', '".$user_id."', '".$comment."', '".$nickname."')";
		
		// 쿼리 실행
		if(mysql_query($sql, $connect)) {
			$result = array("result"=>"true");
		} else {
			$result = array("result"=>"false");
		}

		return $result;
	}

	// 사진 업로드
	function profile_upload($file_path, $user_id){
		// mime 타입 가져오기 위한 변수
		$str = explode('.', $_FILES['uploaded_file']['name']);
		$mime = array_reverse($str) ; // 뒤집어서 첫번째 인덱스에 mime type 오도록설정

		$file_name = "profile_".$user_id.".".$mime[0];
		$file_path = $file_path.$file_name;

		// 사진 서번에 업로드
		if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
			// DB에 URL 저장
			// 데이터베이스 접속
			$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
				die ("SQL server에 연결할 수 없습니다.");
			mysql_query("SET NAMES UTF8");
			mysql_select_db($this->db_dbname, $connect);

			// 세션 시작
			session_start();

			// 쿼리문 생성
			$sql = "UPDATE mapics_user SET user_photo = 'Static/profile/".$file_name."' WHERE user_id = ".$user_id;

			// 쿼리 실행
			if (mysql_query($sql, $connect)) {
				// 성공시
				$result = array('result'=>'true');
			} else {
				// 실패시
				$result = array('result'=>'false');
			}

		} else {
			$result = array('result'=>'false');
		}

		return $result;
	}

	// 지도 캡쳐 업로드
	function map_capture_upload($file_path, $map_id){
		// mime 타입 가져오기 위한 변수
		$str = explode('.', $_FILES['uploaded_file']['name']);
		$mime = array_reverse($str) ; // 뒤집어서 첫번째 인덱스에 mime type 오도록설정

		$file_name = "mapcap_".$map_id.".".$mime[0];
		$file_path = $file_path.$file_name;

		// 사진 서번에 업로드
		if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
			// DB에 URL 저장
			// 데이터베이스 접속
			$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
				die ("SQL server에 연결할 수 없습니다.");
			mysql_query("SET NAMES UTF8");
			mysql_select_db($this->db_dbname, $connect);

			// 세션 시작
			session_start();

			// 쿼리문 생성
			$sql = "UPDATE map_storage SET full_map = 'Static/map_capture/".$file_name."', edit_date = CURRENT_TIMESTAMP() WHERE map_id = ".$map_id;

			// 쿼리 실행
			if (mysql_query($sql, $connect)) {
				// 성공시
				$result = array('result'=>'true');
			} else {
				// 실패시
				$result = array('result'=>'false');
			}

		} else {
			$result = array('result'=>'false');
		}

		return $result;
	}

	// 사진 업로드
	function image_upload($file_path, $img_id){
		// mime 타입 가져오기 위한 변수
		$str = explode('.', $_FILES['uploaded_file']['name']);
		$mime = array_reverse($str) ; // 뒤집어서 첫번째 인덱스에 mime type 오도록설정

		$file_name = "img_".$img_id.".".$mime[0];
		$file_path = $file_path.$file_name;

		// 사진 서번에 업로드
		if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
			// DB에 URL 저장
			// 데이터베이스 접속
			$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
				die ("SQL server에 연결할 수 없습니다.");
			mysql_query("SET NAMES UTF8");
			mysql_select_db($this->db_dbname, $connect);

			// 세션 시작
			session_start();

			// 쿼리문 생성
			$sql = "UPDATE image_storage SET img_url = 'Static/image/".$file_name."' WHERE img_id = ".$img_id;

			// 쿼리 실행
			if (mysql_query($sql, $connect)) {
				// 성공시
				$result = array('result'=>'true');
			} else {
				// 실패시
				$result = array('result'=>'false');
			}

		} else {
			$result = array('result'=>'false');
		}

		return $result;
	}
}

?>