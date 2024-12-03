<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');

	$thal	= ceil($num/$phal);
	$hal	= (isset($_GET['hal'])) ? (int)$_GET['hal'] : 1;
	
	$back	= $hal -1;
	$next 	= $hal +1;

	$backx	= $turi.'&hal='.$back;
	$nextx	= $turi.'&hal='.$next;

		if($hal <= 1){
	$lclass	= ' disabled';
	$backx	= '#';
	}
	else{
	$backx	= $turi.'&hal='.$back;
	$lclass	= '';
	}
		if($hal == $thal){
	$rclass	= ' disabled';
	$nextx	= '#';
	}
	else{
	$rclass	= '';
	$nextx	= $turi.'&hal='.$next;
	}

		if($thal == 0 || $hal == 0 || $hal > $thal){
	$rclass	= ' disabled';
	$lclass	= ' disabled';
	$nextx	= '#';
	$backx	= '#';
	}
	
	
?>