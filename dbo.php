<?php 
//数据库连接
class DBCxn{
    public static $dsn = 'mysql:host=localhost;dbname=webrss';
    public static $user = 'root';
    public static $pass = '1q2w3e';
    //保存连接的内部变量
    private static $db;
    //不能克隆和技巧化
    final private function __construct(){}
    final private function __clone(){}
    
    public static function get(){
        if(is_null(self::$db)){
			try
			{
            	self::$db = new PDO(self::$dsn, self::$user, self::$pass);
			}
			catch (PDOException $e) {
		    	echo 'Connection failed: ' . $e->getMessage();
			}
        }
        //返回连接
        self::$db->query('set names utf8');        
		return self::$db;
    }
}

function my_get_Datetime_Now() {
    $tz_object = new DateTimeZone('PRC');
    //date_default_timezone_set('Brazil/East'); 
    $datetime = new DateTime();
    $datetime->setTimezone($tz_object);     
	return $datetime->format('Y\-m\-d\ h:i:s');
}
?>