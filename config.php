<?php
$config = array(
	'host' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'bible'
	);
$db = new mysqli(
	$config['host'],
	$config['username'],
	$config['password'],
	$config['database']
	);
if (mysqli_connect_errno()){
	echo 'an occured error';
	exit;
}
?>