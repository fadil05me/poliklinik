<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');


$tablelog = 'login';

if($_COOKIE['nama'] && $_COOKIE['pass']){
	$lg		= mysql_query('SELECT * FROM '.$tablelog.' WHERE username="'.dbres($_COOKIE['nama']).'" AND password="'.dbres($_COOKIE['pass']).'"');
	$lg		= mysql_num_rows($lg);
		if($lg){
	$_SESSION['login_user'] = $_COOKIE['nama'];
	header('location: '.$_SERVER['REQUEST_URI']);
	}
}



if($_POST['submit'] == 'ok') {
	$user	= $_POST['username'];
	$pass	= $_POST['pass'];
	$ingat	= $_POST['ingat'];
	$ref	= $_POST['ref'];
	
	if(empty($user) || empty($pass)){
		$errlog	= 'Nama User dan Kata Sandi harus di isi!';
	}
	else{

$l = mysql_query('SELECT * FROM '.$tablelog.' WHERE username="'.dbres($user).'" AND password="'.md5(dbres($pass)).'"');

$l = mysql_num_rows($l);
if ($l){
	
    if ($ingat == '1') {
      setcookie('nama', $user, time()+86400*30);
      setcookie('pass', md5($pass), time()+86400*30);
	}
	$_SESSION['login_user'] = $user;
	header('location: '.$ref);
}
else{
		$errlog	= 'Nama User atau Kata Sandi salah!';

}
	}
}



?>