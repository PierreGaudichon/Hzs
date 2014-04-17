<?php

// Include all the dependencies
// run the `dependencies` file first.

require_once '../flight/flight/Flight.php';
require_once '../sparrow/sparrow.php';
require_once "../hzs.php";


// Set the database. You need to have access to a MySQL database to use it.

/*
Hzs::setDb(array(
	'hostname' => '',
	'database' => '',
	'username' => '',
	'password' => ''
));
*/


// Main route, just a small "Hello world !!"

Hzs::route("/", array(), function($db, $data, $res){

	$res["hello"] = "world";

	return $res;
});


// Another example route, an echo server.

Hzs::route("/echo", array(
	"name"
	), function($db, $data, $res){

		$res["hi"] = $data["name"];

		return $res;
});


// Start the routing.

Hzs::start();

?>