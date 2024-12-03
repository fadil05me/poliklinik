<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');
function cek($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

function hitungdata($s){
	$a = mysql_query($s);
	$la = mysql_fetch_array($a);
	$num = (int)$la['jumlahdata'];
return $num;
}

function dbres($s){
	return mysql_real_escape_string($s);
}

function tglmysql($s){
	$a = explode(' ', $s);
	$tgl = $a[2];
	$thn = $a[3];
	$blntmp = $a[1];
	
	switch($blntmp){
		case 'Jan': $bln = 1;break;
		case 'Feb': $bln = 2;break;
		case 'Mar': $bln = 3;break;
		case 'Apr': $bln = 4;break;
		case 'May': $bln = 5;break;
		case 'Jun': $bln = 6;break;
		case 'Jul': $bln = 7;break;
		case 'Aug': $bln = 8;break;
		case 'Sep': $bln = 9;break;
		case 'Oct': $bln = 10;break;
		case 'Nov': $bln = 11;break;
		case 'Dec': $bln = 12;break;
		
	}
	
	return $thn.'-'.$bln.'-'.$tgl;

}


function vthn($s){
	$a = explode('-', $s);
	$thn = $a[2];

	return $thn;
}

function xsc($s){
	$s = preg_replace('#&(?!\#[0-9]+;)#si','&amp;',$s);
	$s = str_replace('<','&lt;',$s);
	$s = str_replace('>','&gt;',$s);
	$s = str_replace('"','&quot;',$s);
	return $s;
}



function umur($dob){
	if(!$dob) return;
	list($y,$m,$d) = explode('-',$dob);
	$dy = date('Y') - $y;
	$dm = date('m') - $m;
	$dd = date('d') - $d;
	if($dd < 0 || $dm < 0) $dy--;
	return $dy;
}

function redirect($url){
	if(!headers_sent()){
		header('Location: '.$url);
	}else{
		echo '<script type="text/javascript">';
		echo 'window.location.href="'.$url.'";';
		echo '</script>';
		echo '<noscript>';
		echo '<meta http-equiv="refresh" content="5;url='.$url.'" />';
		echo '</noscript>';
	}
	exit;
}

function set_my_messages_to_user($msg){
	if(!$msg) return;
	$r = setcookie('my_messages_to_user',$msg);
	return $r;
}

function my_messages_to_user(){
	if(!$_COOKIE['my_messages_to_user']) return;
	$msg = htmlspecialchars($_COOKIE['my_messages_to_user']);
	$r = '<div align="left" class="alert green lighten-4 green-text text-darken-2 alert-border-right">
	<strong><b><i class="fa fa-info-circle"></i></b></strong> '.$msg.'</div>';
	setcookie('my_messages_to_user','',-3600);
	unset($_COOKIE['my_messages_to_user']);
	return $r;
}




function FormatHarga($float=0){
	$r = number_format($float,0,'.',',');
	return $r;
}

function FlipDate($s,$type){
	switch($type){
		case 'dmy':
			list($y,$m,$d) = explode('-',$s);
			return $d.'-'.$m.'-'.$y;
		break;
		case 'ymd':
			list($d,$m,$y) = explode('-',$s);
			return $y.'-'.$m.'-'.$d;
		break;
	}
	return false;
}




?>