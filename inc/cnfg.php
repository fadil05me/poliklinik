<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');
error_reporting(0);
session_start();
ob_start();
$con = mysql_connect('localhost','root','') or die (mysql_error());

$sdb = mysql_select_db('poliklinik_ahmadfadillah', $con);
if(!$sdb) die ('Database tidak ditemukan');
date_default_timezone_set('Asia/Jakarta');

$user_ck	= $_SESSION['login_user'];
//-- Page --//
$p			= $_GET['p'];
$p_dir		= 'page/';
//-- Actions --//
$act		= $_GET['act'];
$actx		= $p_dir.$p.'/'.$act.'.php';
$inc_dir	= 'inc/';
require_once $inc_dir.'func.php';

// -- Cek Data Login -- //
if($p != 'logout' && $user_ck){
$log_check	= mysql_query('SELECT Username FROM login WHERE Username="'.$user_ck.'"');
if(mysql_num_rows($log_check) < 1){
	redirect('index.php?p=logout');
}
}

?>
