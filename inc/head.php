<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');

echo '	<!DOCTYPE html>
		<html>
		<head>
		<title>'.$title.'</title>';
		
require_once $inc_dir.'css-js.php';
echo '	</head>
		<body class="animated fadeIn">
		<div id="acover">';

require_once $p_dir.'navbar.php';

echo '	<center><div id="content">';
?>