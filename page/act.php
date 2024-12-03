<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');
switch($act){
	case 'view':
	if(file_exists($actx)){
		require_once $actx;
	}
	else{
		require_once $p_dir.'404.php';
		
	}
	break;
	
	
	
	
	case 'add':
	if(file_exists($actx)){
		require_once $actx;
	}
	else{
		require_once $p_dir.'404.php';
		
	}
	break;
	
	
	case 'delete':
	if(file_exists($actx)){
		require_once $actx;
	}
	else{
		require_once $p_dir.'404.php';
		
	}
	break;
	
	
	case 'deletex':
	if(file_exists($actx)){
		require_once $actx;
	}
	else{
		require_once $p_dir.'404.php';
		
	}
	break;
	
	
	
	case 'update':
	if(file_exists($actx)){
		require_once $actx;
	}
	else{
		require_once $p_dir.'404.php';
		
	}
	break;
	
	default:
	
	require_once $p_dir.'404.php';
	break;
	


	case 'view-det':
	if(file_exists($actx)){
		require_once $actx;
	}
	else{
		require_once $p_dir.'404.php';
		
	}
	break;
	
	default:
	
	require_once $p_dir.'404.php';
	break;
	
	
}

?>