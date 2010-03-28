<?php
// Load config and connect to database
require_once('config.php');
require_once('connect.php');
require_once('functions.php');

// Prevent browser caching
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

// Main
if (!isset($_GET['url']) || !isset($_GET['pw']) || $_GET['pw'] != PASSWORD)
{
	header('Content-type: application/json');
	echo '{"error_message":"Bad request"}';
}
else
{
	// Check to see if url exists
	$url = mysql_escape_string($_GET['url']);
	$data = mysql_query("SELECT id FROM links WHERE url = '$url'") or die(mysql_error());
	$info = mysql_fetch_assoc( $data ); 
	$num_rows = mysql_num_rows($data);
	
	if ($num_rows > 0)
	{
		$id = $info['id'];
	}
	else
	{
		$sql = "
			INSERT INTO ".DB_NAME.".`links` (
			`id` ,
			`url` ,
			`created_at`
			)
			VALUES (
			NULL , '".mysql_escape_string($_GET['url'])."', '".time()."'
			)
		";
		
		$data = mysql_query($sql) or die(mysql_error());
		$id = mysql_insert_id();
	}
	
	// Encode row ID into base62
	$encoded = encode($id);
	
	// Ouput short link based on GET params
	// Callback (see bookmarklet instructions)
	if ($_GET['callback'] === 'true')
	{ 
		header('Content-type: application/json');
		echo 'short_callback({"short_url":"'.HOST.$encoded.'"})';
	}
	// Plain text - TinyURL style
	elseif ($_GET['text'])
	{
		echo HOST.$encoded;
	}
	// JSON - bit.ly style
	else
	{
		header('Content-type: application/json');
		echo '{"shortUrl":"'.HOST.$encoded.'"}';
	}
}