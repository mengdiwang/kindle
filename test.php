<?php
//include 'dbo.php';
require 'loadInfo.php';


$ret = initRss("http://www.ifanr.com/feed", "test11");
echo $ret;

function testInsert()
{
	$user = 'test';
	$email = 'test@email.com';
	$pass = sha1('11111');
	
	$db = DBCxn::get();
	
	$str = "ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghigklmnpqrstuvwxyz123456789";
	$verify_string = '';
	for($i=0; $i<32; $i++){
	$verify_string .= $str[mt_rand(0,58)];
	}
	//在这里应该验证用户名是否存在
	$stmt = $db->prepare("INSERT INTO users (userName,pwd,email,registerOn, verified, verifyStr) VALUES (:userName,:pass,:email, :registerOn, 0,:verify_string)");
	$regtime=my_get_Datetime_Now();
	$stmt->bindParam(':registerOn', $regtime, PDO::PARAM_STR);
	$stmt->bindParam(':userName', $user);
	$stmt->bindParam(':pass', $pass);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':verify_string', $verify_string);
	$count = $stmt->execute();
	
	echo "$count has inserted </br>";
}

function testSelect()
{
	$db = DBCxn::get();
    $userName = 'test11';
    $pwd= '11111111'; 
	$st = $db->prepare("SELECT COUNT(access_token) ,verified /*result_sum*/, access_token FROM users WHERE userName=:userName AND pwd =:pwd");
    $st->bindParam(':userName', $userName);
	$st->bindParam(':pwd', sha1($pwd));
	$st->execute();
    $st_result = $st->fetchAll();
	
	print_r($st_result);
}

?>