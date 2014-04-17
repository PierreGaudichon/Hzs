<?php

require_once '../flight/flight/Flight.php';
require_once '../sparrow/sparrow.php';
require_once "../hzs.php";


/*
Hzs::setDb(array(
	'hostname' => '',
	'database' => '',
	'username' => '',
	'password' => ''
));
*/


Hzs::route("/", array(), function($db, $data, $res){

	$res["hello"] = "world";

	return $res;
});

Hzs::start();

?>