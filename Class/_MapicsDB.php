<?
class _MapicsDB {
	var $db_host = "128.199.102.18";   
	var $db_id = "mapics_admin";  
	var $db_password = "mapics2015";  
	var $db_dbname = "post_at"; 

	// SQL Injection 공격 방지함수
	function anti_sqlinjection() {
		if (!get_magic_quotes_gpc()) {
			foreach($_POST as $k => $v) {
				$_POST[$k] = addslashes($v);
			}
			foreach($_GET as $k => $v) {
				$_GET[$k] = addslashes($v);
			}
			foreach($_SERVER as $k => $v) {
				$_SERVER[$k] = addslashes($v);
			}
			foreach($_COOKIE as $k => $v) {
				$_COOKIE[$k] = addslashes($v);
			}
		}
	}
}

?>