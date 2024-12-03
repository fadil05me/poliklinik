<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');


	$title	= 'Update Data';
	require_once $inc_dir.'head.php';
	$id		= xsc($_GET['id']);
	$field	= 'kodeobat';
		if($id){

	$get	= mysql_fetch_array(mysql_query('SELECT * FROM '.$p.' WHERE '.$field.'="'.dbres($id).'"'));
		if($get){


	$nmobat		= $_POST['nmobat'];
	$merk		= $_POST['merk'];
	$satuan		= $_POST['satuan'];
	$hargajual	= $_POST['hargajual'];



		if($_POST['submit'] == 'ok'){
	


	// -- Validasi Nama Obat --//
	
			if(!$nmobat){
	$err['nmobat']	= 'Harap Masukkan Nama Obat!';

	}
	elseif (strlen(trim($nmobat))<3) {
	$err['nmobat']	= 'Nama Obat Harus Diisi Min. 3 Karakter';

	}
	elseif (strlen(trim($nmobat))>25) {
	$err['nmobat']	= 'Nama Obat Harus Diisi Max. 25 Karakter';

	}

	// --  Validasi Merk -- //
			if(!$merk){
	$err['merk']	= 'Harap Masukkan Merk!';
	
	}
	elseif (strlen(trim($merk))<3) {
	$err['merk']	= 'Merk Harus Diisi Min. 3 Karakter';

	}
	elseif (strlen(trim($merk))>50) {
	$err['merk']	= 'Merk Harus Diisi Max. 50 Karakter';

	}
	

	
	
	// -- Validasi Satuan -- //
	
			if(!$satuan){
	$err['satuan']	= 'Harap Masukkan Satuan!';
	
	}
	elseif (strlen(trim($satuan))>20) {
	$err['satuan']	= 'Harus Diisi Max. 20 Karakter';
	
	}
	elseif (strlen(trim($satuan))<3) {
	$err['satuan']	= 'Harus Diisi Min. 3 Karakter';
	
	}
	
	
	
	// -- Validasi Harga Jual -- //
	
			if(!$hargajual){
	$err['hargajual']	= 'Harap Masukkan Harga Jual!';
	
	}
	elseif (!is_numeric($hargajual)){
	
	$err['hargajual']	= 'Hanya Boleh Diisi Dengan Angka';
	}
	elseif (strlen(trim($hargajual))<3){
	
	$err['hargajual']	= 'Harus Diisi Min. 3 Karakter';
	}
	elseif (strlen(trim($hargajual))>7){ 
	
	$err['hargajual']	= 'Harus Diisi Max. 7 Karakter';
	}
	
	
			if (!$err){
				
	$x		=	mysql_query('UPDATE '.$p.' SET 
				nmobat="'.dbres($nmobat).'", merk="'.dbres($merk).'", satuan="'.dbres($satuan).'", hargajual="'.dbres($hargajual).'" 
				WHERE kodeobat="'.dbres($id).'"');

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
	echo '	<tr><td> Kode Obat </td> <td> : </td> <td> <div class="input-field"><input id="input1" type="text" name="kodeobat" value="'.$get['kodeobat'].'" disabled/>
			<label for="input1">Kode Obat</label></div></td></tr>';
	
		if($err['kodeobat']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['kodeobat'].'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Nama Obat </td> <td> : </td> <td> <div class="input-field"><input id="input2" type="text" name="nmobat" value="'.$get['nmobat'].'" />
			<label for="input2">Nama Obat</label></div></td></tr>';
		if($err['nmobat']){
		echo '<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['nmobat'].'</font></div></td></tr>';
		
	}
		
	echo '	<tr><td> Merk </td> <td> : </td> <td> <div class="input-field"><input id="input3" type="text" name="merk" value="'.$get['merk'].'" />
			<label for="input3">Merk</label></div> </td></tr>';

		if($err['merk']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['merk'].'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Satuan </td> <td> : </td> <td> <div class="input-field"><input id="input4" type="text" name="satuan" 
			value="'.$get['satuan'].'" />
			<label for="input4">Satuan</label></div> </td></tr>';

		if($err['satuan']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['satuan'].'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Harga Jual </td> <td> : </td> <td> <div class="input-field"><input id="input5" type="text" name="hargajual" 
			value="'.$get['hargajual'].'" />
			<label for="input5">Harga Jual</label></div> </td></tr>';

		if($err['hargajual']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['hargajual'].'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td colspan="3"><center><input type="hidden" name="submit" value="ok" />
			<button class="btn btn-primary" 
			><i class="fa fa-check-circle"> Update</i></button></form>
			<a href="index.php?p='.$p.'&act=view" class="btn btn-danger red" 
			><i class="fa fa-times-circle"> Batal</i></a>
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