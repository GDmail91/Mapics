<?
include 'Valid_check.php';
include 'password.php';

/////////////////////// CONTROLLER CLASS

class Auth {
	// 회원 등록하기
	function register($nickname, $password, $re_password, $phone, $email) {
		$msg = ""; // 오류 메세지 출력 변수
		// 유효성 검증
		$Valid = new valid_check; 
		$arr = array( 
			'name'=>array('이름',$nickname), 
			'password'=>array('비밀번호',$password), 
			're_password'=>array('비밀번호 확인',$re_password), 
			'phone'=>array('전화번호',$phone), 
			'email'=>array('이메일',$email,'detail') // detail에 추가 요소 넣을수 있음
			); 

		if($Valid->Server_Check($arr) === false){
			// 유효성 검증 실패
			$msg = '유효성 검증 실패';
		} else {
			$msh = '유효성 검증 성공';
			// 비밀번호 보안
			$hash = password_hash($password, PASSWORD_BCRYPT);
			
			// 데이터베이스 로드
			$userDB = new Mapics_user;

			// SQL Injection 공격 방지
			$userDB->anti_sqlinjection();
			$db_email = $userDB->get_user_by_email($email);
			if($db_email != null) {
				$msg = '이메일이 이미 있습니다.';
				$result = array(
					'result'=>'false',
					'msg'=>$msg
					);
				return $result;
			}
			echo $db_email;

			$db_result = $userDB->adduser(array(
				'nickname'=>$nickname,
				'email'=>$email,
				'password'=>$hash,
				'phone'=>$phone
			));

			if ($db_result) {
				$msg = '회원가입에 성공했습니다.';
			} else {
				$msg = '회원가입 실패';
			}
		}

		$result = array(
			'result'=>($db_result) ? 'true' : 'false',
			'msg'=>$msg
			);
		return $result;
	}

	function login($email, $password) {
		session_start();
		$userDB = new Mapics_user;
		$user_data = $userDB->login(array(
				'email'=>$email
			));

		if ($user_data['email'] === $email && password_verify($password, $user_data['password'])) {
			$_SESSION['username'] = $user_data['nickname'];
			$_SESSION['user_id'] = $user_data['user_id'];
			$_SESSION['is_login'] = true;
			$result = array('result'=>'true');
		} else {
			$result = array('result'=>'false');
		}

		return $result;
	}

	function logout() {
		session_start();

		// 세션을 비워준다
		session_destroy();

		// 현재 세션의 모든 세션 변수 값을 삭제한다.
		$_SESSION = array();
		echo '로그아웃 되었습니다.';
	}

	// 사용자 정보 가져옴
	function user_info($user_id) {
		// DB 접속
		$db = new Mapics_user;
		// 사용자 정보 가져옴
		$user_ident = $db->get_user_info($user_id);
		$user_following = $db->get_user_following($user_id);
		$user_follower = $db->get_user_follower($user_id);

		array_push($user_ident, array('follower'=>$user_follower['follower'], 'following'=>$uesr_following['following']));
		//$result = $user_ident;
		return $user_ident;
	}

	function set_follow($user_id, $dest_id) {
		// DB 접속
		$db = new Mapics_user;
		// 사용자 정보 가져옴
		$db->anti_sqlinjection();
		$db_result = $db->set_follow($user_id, $dest_id);

		$follow_result = "{\"result\":\"".$db_result."\"}";
		return $follow_result;
	}

	function set_unfollow($user_id, $dest_id) {
		// DB 접속
		$db = new Mapics_user;
		// 사용자 정보 가져옴
		$db->anti_sqlinjection();
		$db_result = $db->set_unfollow($user_id, $dest_id);

		$follow_result = "{\"result\":\"".$db_result."\"}";
		return $follow_result;
	}

	function get_follow($user_id) {
		// DB 접속
		$db = new Mapics_user;
		// 사용자 정보 가져옴
		$db_result = $db->get_follow($user_id);

		return $db_result;
	}

	function is_follow($user_id) {
		// DB 접속
		$db = new Mapics_user;
		// 사용자 정보 가져옴
		$db_result = $db->is_follow($user_id);

		return $db_result;
	}

	function edit_user($user_id, $nickname, $career, $email, $phone, $user_photo) {
		// 데이터베이스 업로드
		$userDB = new Mapics_user;
		// SQL Injection 공격 방지
		$userDB->anti_sqlinjection();
		$db_result = $userDB->set_user($user_id, array(
			'nickname'=>$nickname,
			'career'=>$career,
			'email'=>$email,
			'phone'=>$phone));
		if ($db_result ===true)
			$edit_result = "{\"result\"=\"true\"}";
		else 
			$edit_result = "{\"result\"=\"false\"}";

		return $edit_result;
	}
}

////////////////////// MODEL CALSS
include_once '_MapicsDB.php';

class Mapics_user extends _MapicsDB {
	function adduser($user_info) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "INSERT INTO mapics_user (nickname, email, password, phone) VALUES ('".$user_info['nickname']."', '".$user_info['email']."', '".$user_info['password']."', '".$user_info['phone']."')";
		
		// 쿼리 실행
		$result = mysql_query($sql, $connect);

		return $result;
	}

	function login($user_info) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "SELECT user_id, nickname, email, password, phone, user_photo FROM mapics_user WHERE email ='".$user_info['email']."'";
		// 쿼리 실행
		$result = mysql_query($sql, $connect);
		// 쿼리 실행 결과
		$row = mysql_fetch_assoc($result);
		
		return $row;
	}

	function _session_log() {
		session_id(); // 세션 id
		session_name(); // 세션이름
		session_get_cookie_params(); // 세션 데이터
	}

	function get_user_by_email($email) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "SELECT email FROM mapics_user WHERE email ='".$email."'";
		// 쿼리 실행
		$result = mysql_query($sql, $connect);
		// 쿼리 실행 결과
		$row = mysql_fetch_assoc($result);
		
		return $row;
	}

	function get_user_info($user_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "SELECT name, email, phone, nickname, career, user_photo FROM mapics_user WHERE user_id =".$user_id;
		// 쿼리 실행
		$result = mysql_query($sql, $connect);
		// 쿼리 실행 결과를 배열 형태로 담음
		$resultArray = array ();  
		while ( $row = mysql_fetch_assoc($result)) {  
			$arrayMiddle = array (  
				"name" => $row ['name'] ,
				"email" => $row ['email'],
				"phone" => $row ['phone'],
				"nickname" => $row ['nickname'],
				"career" => $row ['career'],
				"user_photo" => $row['user_photo']
			);
			// $resultArray에 담기
			array_push($resultArray, $arrayMiddle);  
		}

		return $resultArray;
	}

	function get_user_following($user_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "SELECT COUNT(following) AS following FROM follow WHERE follower =".$user_id;
		// 쿼리 실행
		$result = mysql_query($sql, $connect);
		// 쿼리 실행 결과
		$row = mysql_fetch_assoc($result);
		
		return $row;
	}

	function get_user_follower($user_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "SELECT COUNT(follower) AS follower FROM follow WHERE following =".$user_id;
		// 쿼리 실행
		$result = mysql_query($sql, $connect);
		// 쿼리 실행 결과
		$row = mysql_fetch_assoc($result);
		
		return $row;
	}

	function set_user($user_id, $user_info) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "UPDATE mapics_user SET ";
		foreach ($user_info as $pop => $pop_val) {
			each($user_info);
			if ($pop_val != null) {
				$sql .= $pop."= '".$pop_val."'";				
				if (current($user_info))
					$sql .= ", ";		
			}
		}
		$sql .= " WHERE user_id = ".$user_id;
		
		echo $sql;
		// 쿼리 실행
		$result = mysql_query($sql, $connect);

		return $result;
	}

	function set_follow($user_id, $dest_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "INSERT INTO follow (follower, following) VALUES ('".$user_id."', '".$dest_id."')";
		
		// 쿼리 실행
		$result = mysql_query($sql, $connect);

		return $result;
	}

	function set_unfollow($user_id, $dest_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "DELETE FROM follow WHERE follower=".$user_id." AND following=".$dest_id;
		
		// 쿼리 실행
		$result = mysql_query($sql, $connect);

		return $result;
	}

	function get_follow($user_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "SELECT following FROM follow WHERE follower ='".$user_id."'";

		// 쿼리 실행
		$result = mysql_query($sql, $connect);
		// 쿼리 실행 결과를 배열 형태로 담음
		$resultArray = array ();
		while ( $row = mysql_fetch_assoc($result)) {  
			// $resultArray에 담기
			array_push($resultArray, $row['following']);  
		}
		return $resultArray;
	}

	function is_follow($user_id, $dest_id) {
		// 데이터베이스 접속
		$connect = mysql_connect( $this->db_host, $this->db_id, $this->db_password) or  
			die ("SQL server에 연결할 수 없습니다.");
		mysql_query("SET NAMES UTF8");
		mysql_select_db($this->db_dbname, $connect);

		// 세션 시작
		session_start();

		// 쿼리문 생성
		$sql = "SELECT following FROM follow WHERE follower ='".$user_id."' AND following ='".$dest_id."'";

		// 쿼리 실행
		$result = mysql_query($sql, $connect);

		return $result;
	}
}
?>