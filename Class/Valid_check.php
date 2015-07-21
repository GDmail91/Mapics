<?
 
// 유효성 검증
class Valid_check { 
	function Valid_check() {} 

	# 팝업 
	function pop_msg($msg,$back="-1") { 
		echo "{	\"msg\":\"".$msg."\"	}"; 
	} 

	# 이메일 주소 체크 함수 
	function check_email($email,$name) { 
		if (!eregi("^[^@ ]+@[a-zA-Z0-9\-\.]+\.+[a-zA-Z0-9\-\.]", $email)) { 
			$this->pop_msg($name."이 형식에 맞지 않습니다."); 
			return FALSE; 
		} 
	} 

	# php valid 체크 
	function Server_Check($arr) {          
		while (list($key,$val) = each($arr)) { 
			$val[1] = trim($val[1]); 
			if (ereg("(^[[:space:]]+)", $val[1]) || $val[1] == ""){ 
				$this->pop_msg($val[0]."(을)를 입력하세요"); 
				return FALSE; 
			} else if ($key == 'email' && $val[2] == 'detail'){ 
				if($this->check_email($val[1],$val[0]))
					return FALSE; 
			} 
		} 
		return TRUE;
	} 
} 

?> 