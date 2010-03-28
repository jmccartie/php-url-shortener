<?php 
// Load config and connect to database
require_once('config.php');
require_once('connect.php');
require_once('functions.php');

// Parse request from uri string
$temp = explode('/', $_SERVER['REQUEST_URI']);
$request = decode($temp[1]);

// Select from database based on decoded ID
$sql = "SELECT id, url, created_at FROM links WHERE id = $request";
$data = mysql_query($sql) or die(mysql_error());
$info = mysql_fetch_assoc( $data ); 
$num_rows = mysql_num_rows($data);

if ($num_rows < 1)
{
	die('ERROR: invalid url');
}
else
{
	// Record view
	$sql = "
		INSERT INTO ".DB_NAME.".`views` (
			`view_id` ,
			`link_id`,
			`user_ip`,
			`user_agent`,
			`created_at`
		)
		VALUES (
			NULL, 
			".$info['id'].",
			'".$_SERVER['REMOTE_ADDR']."',
			'".$_SERVER['HTTP_USER_AGENT']."', 
			".time()."			
		)
	";
	mysql_query($sql) or die(mysql_error());
	// Redirect to URL
	header('Location: '.$info['url']);
}
?> 