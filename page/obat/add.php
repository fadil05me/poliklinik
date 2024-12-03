<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');


	//-- Config --//


	$title	= 'Tambah Data';
	
	require_once $inc_dir.'head.php';

	$nmobat		= xsc($_POST['nmobat']);
	$merk		= xsc($_POST['merk']);
	$satuan		= xsc($_POST['satuan']);
	$hargajual	= xsc($_POST['hargajual']);

	
							$cex	= hitungdata('SELECT kodeobat, COUNT(kodeobat) AS jumlahdata FROM '.$p);
	if($cex < 1){
		$kodeobat = 'OB10001';
	}
	else{
	$cex = mysql_fetch_array(mysql_query('SELECT kodeobat FROM '.$p.' ORDER BY urutan DESC LIMIT 0, 1'));
	$kodeobat	= str_replace('OB', '', $cex['kodeobat']);
	$kodeobat	= $kodeobat+1;
	$kodeobat	= 'OB'.$kodeobat;
	}


	// -- Validasi --//
		if ($_POST['submit'] == 'ok') {
	
	
	
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
	


	if(!$err){
		$cek = mysql_query('SELECT kodeobat FROM '.$p.' WHERE kodeobat="'.dbres($kodeobat).'"');
		if(mysql_num_rows($cek)>0){
	echo '<h6 class="page-header wow bounceIn" data-wow-delay=".7s"><font color="red">Kode Obat Sudah Ada!</font></h6><br />';
		}
	else {		
			
		$x = mysql_query('INSERT INTO '.$p.' 
			VALUES("'.dbres($kodeobat).'", "'.dbres($nmobat).'", 
			"'.dbres($merk).'", "'.dbres($satuan).'", "'.dbres($hargajual).'", "")');
	if($x){
	set_my_messages_to_user('Data Berhasil Ditambahkan!');
	redirect('index.php?p='.$p.'&act=view');
	exit;
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
	<tr><td>Kode Obat </td> <td> : </td> <td><div class="input-field"><input id="input1" type="text" name="kodeobat" value="'.$kodeobat.'" disabled/>
	<label for="input1">Kode Obat</label></div></td></tr>';


		if($err['kodeobat']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['kodeobat'].'</font></div></td></tr>';
}


	echo '	<tr><td>Nama Obat </td> <td> : </td> <td><div class="input-field"><input id="input2" type="text" name="nmobat" value="'.$nmobat.'" />
			<label for="input2">Nama Obat</label></div></td></tr>';

		if($err['nmobat']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['nmobat'].'</font></div></td></tr>';
}

	echo '	<tr><td>Merk </td> <td> : </td> <td><div class="input-field">
			<input id="input3" type="text" name="merk" value="'.$merk.'" /><label for="input3">Merk</label></div></td></tr>';


		if($err['merk']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['merk'].'</font></div></td><tr>';
}

	echo '	<tr><td>Satuan</td> <td> : </td> <td><div class="input-field"><input type="text" id="input4" name="satuan" value="'.$satuan.'" />
			<label for="input4">Satuan</label></div></td></tr>';


		if($err['satuan']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['satuan'].'</font></div></td><tr>';
}

	echo '	<tr><td> Harga Jual </td> <td> : </td> <td> <div class="input-field"><input id="input5" type="text" name="hargajual" 
			value="'.$hargajual.'" />
			<label for="input5">Harga Jual</label></div> </td></tr>';

		if(isset($err['hargajual'])){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['hargajual'].'</font></div></td></tr>';
	
	}


	echo '	<tr><td colspan="3"><center><button class="btn btn-primary"
			>
			<i class="fa fa-plus"> Tambah</i></button></form>
			<a href="index.php?p='.$p.'&act=view">
			<button class="btn btn-danger red"
			>
			<i class="fa fa-times"> Batal</i></button></a></center></td></tr></table>';

?>