<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');

$position	= 'SELECT Typeuser FROM login WHERE Username = "'.$user_ck.'"';
$position	= mysql_fetch_array(mysql_query($position));

if($position['Typeuser'] == 'Admin'){
	$auth = '1';
}
elseif($position['Typeuser'] == 'Manager'){
	$auth = '2';
}
elseif($position['Typeuser'] == 'Operator'){
	$auth = '3';
}

?>