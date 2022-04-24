<?php 
include 'Config.php';

class Model{
	
	private $_connection = null;
	private static $_instance;
	
	const _DB_HOST = DB_HOST;
	const _DB_USER = DB_USER;
	const _DB_PASS = DB_PASS;
	const _DB_NAME = DB_NAME;	
	
	
	public static function getInstance() {
		if(!self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function getConnection(){
		$this->_connection = mysqli_connect(self::_DB_HOST, self::_DB_USER, self::_DB_PASS, self::_DB_NAME);	
		
		return $this->_connection;
	}
	
	public function getData($sql){
		$result = self::getInstance()->getConnection()->query($sql);
		$rows = array();
		while($row = mysqli_fetch_assoc($result)){
			$rows[] = $row;
		}
		
		return $rows;
	}
}
?>