<?php


session_start();

$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'user' => 'root',
		'pass' => 'root',
		'dbname' => 'test'
	),
	'remember' => array( 
		'cookie_name' => 'hash',
		'cookie_expire' => 604800
	),
	'session' => array(
		'session_name' => 'user',
		'token_name' => 'token'
	),
	'genres' => array(
		'Alternative', 'Blues', 'Classical', 'Country', 'Disco', 'Drum and Bass', 'Dubstep', 'Electronic', 'Folk', 'Hardcore', 'Hip Hop', 'House', 'Indie',
		'Jazz', 'Latin', 'Metal', 'Minimal', 'Other', 'Piano', 'Pop', 'Progressive', 'Punk', 'R&amp;B', 'Rap', 'Raggae', 'Rock', 'Soul', 'Techno', 'Trap', 'World'
	)
);

define('MB', 1048576);

spl_autoload_register( function($class) {
	require_once( 'classes/'.$class.'.php');
});

require_once('functions/sanitize.php');
require_once('classes/Carbon.php');

?>