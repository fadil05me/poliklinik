<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');


	//-- Config --//


	$title	= 'Tambah Data';
	
	require_once $inc_dir.'head.php';
	
	$namapoli	= xsc($_POST['namapoli']);
	$Typeuser	= xsc($_POST['Typeuser']);
	
	
	
	$cex	= hitungdata('SELECT kodepoli, COUNT(kodepoli) AS jumlahdata FROM '.$p);
	if($cex < 1){
		$kodepoli = 'KP10001';
	}
	else{
	$cex = mysql_fetch_array(mysql_query('SELECT kodepoli FROM '.$p.' ORDER BY urutan DESC LIMIT 0, 1'));
	$kodepoli	= str_replace('KP', '', $cex['kodepoli']);
	$kodepoli	= $kodepoli+1;
	$kodepoli	= 'KP'.$kodepoli;
	}
	
	
	
	
	// -- Validasi --//
		if ($_POST['submit'] == 'ok') {
	
	


	
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



	if(!$err){
		$cek = mysql_query('SELECT kodepoli FROM '.$p.' WHERE kodepoli="'.dbres($kodepoli).'"');
		if(mysql_num_rows($cek)>0){
	echo '<h6 class="page-header wow bounceIn" data-wow-delay=".7s"><font color="red">Kode Poli Sudah Ada!</font></h6>';
		}
	else {		
			
		$x = mysql_query('INSERT INTO '.$p.' 
			VALUES("'.dbres($kodepoli).'", "'.dbres($namapoli).'", "")');
	if($x){
set_my_messages_to_user('Data Berhasil Ditambahkan!');
redirect('index.php?p='.$p.'&act=view');

	}
	else {
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Gagal Ditambahkan!</h2>';
	
	}
	}
	}
	}


	echo '
	<table class="table table-bordered">
	<form method="post">
	<input type="hidden" name="submit" value="ok" />
	<tr><td>Kode Poli </td> <td> : </td> <td><div class="input-field"><input id="input1" type="text" name="kodepoli" value="'.$kodepoli.'" disabled/>
	<label for="input1">Kode Poli</label></div></td></tr>';



	echo '	<tr><td>Nama Poli </td> <td> : </td> <td><div class="input-field">
			<input id="input2" type="text" name="namapoli" value="'.$namapoli.'" />
			<label for="input2">Nama Poli</label></div></td></tr>';

		if($err['namapoli']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['namapoli'].'</font></div></td></tr>';
}





	echo '	<tr><td colspan="3"><center><button class="btn btn-primary">
			<i class="fa fa-plus"> Tambah</i></button></form>
			<a href="index.php?p='.$p.'&act=view">
			<button class="btn btn-danger red">
			<i class="fa fa-times"> Batal</i></button></a></center></td></tr></table>';

?>