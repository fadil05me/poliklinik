<?php

	//-- Config --//


	$title	= 'Tambah Data';
	
	require_once $inc_dir.'head.php';

	$kodeobat	= $_POST['kodeobat'];
	$nmobat		= $_POST['nmobat'];
	$merk		= $_POST['merk'];
	$satuan		= $_POST['satuan'];
	$hargajual	= $_POST['hargajual'];


	// -- Jika Sukses -- //
		if (isset($_GET['ok'])) {
	echo '<meta http-equiv="Refresh" content="2; URL=index.php?p='.$p.'&act=view">';
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Berhasil Ditambahkan!</h2>';
	require_once $inc_dir.'foot.php';
	exit;
}

	// -- Validasi --//
		if ($_POST['submit'] == 'ok') {
	
	
	// -- Validasi Kode Obat -- //
	
			if(!$kodeobat){
	$err1	= 'Harap Masukkan Kode Obat!';

	}
	elseif (strlen(trim($kodeobat))< 3) {
	$err1	= 'Kode Obat Harus Diisi Min. 3 Karakter';

	}
	elseif (strlen(trim($kodeobat))> 10) {
	$err1	= 'Kode Obat Harus Diisi Max. 10 Karakter';

	}
	
	// -- Validasi Nama Obat --//
	
			if(!$nmobat){
	$err2	= 'Harap Masukkan Nama Obat!';

	}
	elseif (strlen(trim($nmobat))<3) {
	$err2	= 'Nama Obat Harus Diisi Min. 3 Karakter';

	}
	elseif (strlen(trim($nmobat))>25) {
	$err2	= 'Nama Obat Harus Diisi Max. 25 Karakter';

	}

	// --  Validasi Merk -- //
			if(!$merk){
	$err3	= 'Harap Masukkan Merk!';
	
	}
	elseif (strlen(trim($merk))<3) {
	$err3	= 'Merk Harus Diisi Min. 3 Karakter';

	}
	elseif (strlen(trim($merk))>50) {
	$err3	= 'Merk Harus Diisi Max. 50 Karakter';

	}
	

	
	
	// -- Validasi Satuan -- //
	
			if(!$satuan){
	$err4	= 'Harap Masukkan Satuan!';
	
	}
	elseif (strlen(trim($satuan))>20) {
	$err4	= 'Harus Diisi Max. 20 Karakter';
	
	}
	elseif (strlen(trim($satuan))<3) {
	$err4	= 'Harus Diisi Min. 3 Karakter';
	
	}
	
	
	
	// -- Validasi Harga Jual -- //
	
			if(!$hargajual){
	$err5	= 'Harap Masukkan Harga Jual!';
	
	}
	elseif (!is_numeric($hargajual)){
	
	$err5	= 'Hanya Boleh Diisi Dengan Angka';
	}
	elseif (strlen(trim($hargajual))<3){
	
	$err5	= 'Harus Diisi Min. 3 Karakter';
	}
	elseif (strlen(trim($hargajual))>7){ 
	
	$err5	= 'Harus Diisi Max. 7 Karakter';
	}
	


	if(!$err1 && !$err2 && !$err3 && !$err4 && !$err5){
		$cek = mysql_query('SELECT kodeobat FROM '.$p.' WHERE kodeobat="'.dbres($kodeobat).'"');
		if(mysql_num_rows($cek)>0){
	echo '<h6 class="page-header wow bounceIn" data-wow-delay=".7s"><font color="red">Kode Obat Sudah Ada!</font></h6><br />';
		}
	else {		
			
		$x = mysql_query('INSERT INTO '.$p.' 
			VALUES("'.dbres($kodeobat).'", "'.dbres($nmobat).'", 
			"'.dbres($merk).'", "'.dbres($satuan).'", "'.dbres($hargajual).'")');
	if($x){
		header('location: ?p='.$p.'&act=add&ok');
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
	<tr><td>Kode Obat </td> <td> : </td> <td><div class="input-field"><input id="input1" type="text" name="kodeobat" value="'.$kodeobat.'" />
	<label for="input1">Kode Obat</label></div></td></tr>';


		if($err1){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err1.'</font></div></td></tr>';
}


	echo '	<tr><td>Nama Obat </td> <td> : </td> <td><div class="input-field"><input id="input2" type="text" name="nmobat" value="'.$nmobat.'" />
			<label for="input2">Nama Obat</label></div></td></tr>';

		if($err2){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err2.'</font></div></td></tr>';
}

	echo '	<tr><td>Merk </td> <td> : </td> <td><div class="input-field">
			<input id="input3" type="text" name="merk" value="'.$merk.'" /><label for="input3">Merk</label></div></td></tr>';


		if($err3){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err3.'</font></div></td><tr>';
}

	echo '	<tr><td>Satuan</td> <td> : </td> <td><div class="input-field"><input type="text" id="input4" name="satuan" value="'.$satuan.'" />
			<label for="input4">Satuan</label></div></td></tr>';


		if($err4){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err4.'</font></div></td><tr>';
}

	echo '	<tr><td> Harga Jual </td> <td> : </td> <td> <div class="input-field"><input id="input5" type="text" name="hargajual" 
			value="'.$get['hargajual'].'" />
			<label for="input5">Harga Jual</label></div> </td></tr>';

		if(isset($err5)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err5.'</font></div></td></tr>';
	
	}


	echo '	<tr><td colspan="3"><center><button class="wow bounceInDown btn-floating btn-large waves-effect waves-light blue"
			data-container="body" data-toggle="popover" type="submit" data-wow-delay=".5s" data-placement="left" data-trigger="hover" data-content="Tambah Data">
			<i class="fa fa-plus"></i></button></form>
			<a href="index.php?p='.$p.'&act=view">
			<button class="wow bounceInDown btn-floating btn-large waves-effect waves-light red"
			data-container="body" data-toggle="popover" data-wow-delay="1s" data-placement="right" data-trigger="hover" data-content="Batal">
			<i class="fa fa-times"></i></button></a></center></td></tr></table>';

?>