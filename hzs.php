<?php

class Hzs
{

	static $db = null;

	static $message = array(
		"status" => "ok",
		"message" => "no-errors"
	);

	static $displayRoute = true;

	static function setDb(array $arr){

		self::$db = new Sparrow();

		self::$db->setDb(array(
			'type' => 'pdomysql',
			'hostname' => $arr["hostname"],
			'database' => $arr["database"],
			'username' => $arr["username"],
			'password' => $arr["password"]
		));
	}

	static function route($route, $post, $fun){
		Flight::route($route, function() use($route, $post, $fun) {
			$res = self::$message;

			if(self::$displayRoute){
				$res["route"] = $route;
			}

			$data = array();
			$error = false;
			foreach ($post as $var) {
				if(isset($_POST[$var])){
					$data[$var] = $_POST[$var];
				}
				else{
					$error = true;
					$res["message"] = "missing_post_data";
					$res["status"] = "error";
				}
			}

			$funRes = null;
			if(!$error){
				$funRes = $fun(self::$db, $data, $res);
			}

			if($funRes != null){
				$res = $funRes;
			}

			echo json_encode($res);
		});
	}

	static function start(){
		Flight::start();
	}

}

?>