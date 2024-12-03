<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');
session_destroy();
$_SESSION = array();
unset($_COOKIE['nama']);
unset($_COOKIE['pass']);
setcookie('nama', '');
setcookie('pass', '');
header('location: index.php');

$title = 'Keluar';
require_once 'inc/head.php';
echo '<h2 class="page-header wow bounceIn">Proses Keluar...!</h2>';
?>
