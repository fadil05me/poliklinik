<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');

	$title	= 'Update Data';
	require_once $inc_dir.'head.php';
	$id		= xsc($_GET['id']);
	$field	= 'kodepoli';
		if($id){

	$get	= mysql_fetch_array(mysql_query('SELECT * FROM '.$p.' WHERE '.$field.'="'.dbres($id).'"'));
		if($get){


	$namapoli	= $_POST['namapoli'];



		if($_POST['submit'] == 'ok'){

	
	
	
	// -- Validasi Nama Poli -- //
	
			if(!$namapoli){
	$err['namapoli']	= 'Harap Masukkan Nama Poli!';

	}
	elseif (!preg_match("/^[a-zA-Z ]*$/",$namapoli)) {
	$err['namapoli']	= 'Hanya Boleh Diisi Oleh Huruf dan Spasi';

	}
	elseif (strlen(trim($namapoli))< 3) {
	$err['namapoli']	= 'Nama Poli Harus Diisi Min. 3 Karakter';

	}
	elseif (strlen(trim($namapoli))> 20) {
	$err['namapoli']	= 'Nama Poli Harus Diisi Max.20 Karakter';

	}
	
	

	
			if (!$err){
				

				
	$x		=	mysql_query('UPDATE '.$p.' SET 
				namapoli="'.dbres($namapoli).'" WHERE kodepoli="'.dbres($id).'"');

		if($x){
	set_my_messages_to_user('Data Berhasil Diupdate!');
	redirect('index.php?p='.$p.'&act=view');
	exit;
	}
	else {
		
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Gagal Diupdate!</h2>';
	}
	}
	}
	echo '	<table class="table table-bordered"><form method="post">';
	echo '	<tr><td> Kode Poli </td> <td> : </td> <td> <div class="input-field">
			<input id="input1" type="text" name="kodepoli" value="'.$get['kodepoli'].'" disabled/>
			<label for="input1">Kode Poli</label></div></td></tr>';
	
	
	echo '	<tr><td> Nama Poli </td> <td> : </td> <td> <div class="input-field"><input id="input2" type="text" name="namapoli" value="'.$get['namapoli'].'" />
			<label for="input2">Nama Poli</label></div></td></tr>';
		if($err['namapoli']){
		echo '<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['namapoli'].'</font></div></td></tr>';
		
	}
		

	
	echo '	<tr><td colspan="3"><center><input type="hidden" name="submit" value="ok" />
			<button class="btn btn-primary">
			<i class="fa fa-check-circle"> Update</i></button></form>
			<a href="index.php?p='.$p.'&act=view" class="btn btn-danger red">
			<i class="fa fa-times-circle"> Batal</i></a>
			</center></td></tr></table>';
			
	}
	
	else {
		set_my_messages_to_user('Data Tidak Ada!');
		redirect('index.php?p='.$p.'&act=view');
		exit;
	
	}
	}
	else {
	redirect('index.php?p='.$p.'&act=view');
	
	}
?>