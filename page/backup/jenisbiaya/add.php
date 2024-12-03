<?php

	//-- Config --//


	$title	= 'Tambah Data';
	
	require_once $inc_dir.'head.php';

	$idjenisbiaya	= $_POST['idjenisbiaya'];
	$namabiaya		= $_POST['namabiaya'];
	$tarif			= $_POST['tarif'];


	// -- Jika Sukses -- //
		if (isset($_GET['ok'])) {
	echo '<meta http-equiv="Refresh" content="2; URL=index.php?p='.$p.'&act=view">';
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Berhasil Ditambahkan!</h2>';
	require_once $inc_dir.'foot.php';
	exit;
}

	// -- Validasi --//
		if ($_POST['submit'] == 'ok') {
	
	
	// -- Validasi ID Jenis Biaya -- //
	
			if(!$idjenisbiaya){
	$err1	= 'Harap Masukkan ID Jenis Biaya!';

	}
	elseif(!is_numeric($idjenisbiaya)){
	$err1	= 'Hanya Boleh Diisi Dengan Angka!';

	}
	elseif (strlen(trim($idjenisbiaya))< 5) {
	$err1	= 'ID Jenis Biaya Harus Diisi 5 Angka';

	}
	elseif (strlen(trim($idjenisbiaya))> 5) {
	$err1	= 'ID Jenis Biaya Harus Diisi 5 Angka';
	
	}
	
	// -- Validasi Nama Biaya --//
	
			if(!$namabiaya){
	$err2	= 'Harap Masukkan Nama Biaya!';

	}
	elseif (!preg_match("/^[a-zA-Z ]*$/",$namabiaya)) {
	$err2	= 'Hanya Boleh Diisi Oleh Huruf dan Spasi';

	}
	elseif (strlen(trim($namabiaya))<3) {
	$err2	= 'Nama Biaya Harus Diisi Min. 3 Digit';

	}
	elseif (strlen(trim($namabiaya))>25) {
	$err2	= 'Nama Biaya Harus Diisi Max. 25 Digit';

	}

	// --  Validasi Tarif -- //
			if(!$tarif){
	$err3	= 'Harap Masukkan Tarif!';
	
	}
	elseif (strlen(trim($tarif))<3) {
	$err3	= 'Tarif Harus Diisi Min. 3 Digit';

	}
	elseif (strlen(trim($tarif))>10) {
	$err3	= 'Tarif Harus Diisi Max. 10 Digit';

	}
	



	if(!$err1 && !$err2 && !$err3){
		$cek = mysql_query('SELECT idjenisbiaya FROM '.$p.' WHERE idjenisbiaya="'.dbres($idjenisbiaya).'"');
		if(mysql_num_rows($cek)>0){
	echo '<h6 class="page-header wow bounceIn" data-wow-delay=".7s"><font color="red">ID Jenis Biaya Sudah Ada!</font></h6><br />';
		}
	else {		
			
		$x = mysql_query('INSERT INTO '.$p.' 
			VALUES("'.dbres($idjenisbiaya).'", "'.dbres($namabiaya).'", 
			"'.dbres($tarif).'")');
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
	<tr><td>ID Jenis Biaya </td> <td> : </td> <td><div class="input-field"><input id="input1" type="text" name="idjenisbiaya" value="'.$idjenisbiaya.'" />
	<label for="input1">ID Jenis Biaya</label></div></td></tr>';


		if($err1){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err1.'</font></div></td></tr>';
}


	echo '	<tr><td>Nama Biaya </td> <td> : </td> <td><div class="input-field"><input id="input2" type="text" name="namabiaya" value="'.$namabiaya.'" />
			<label for="input2">Nama Biaya</label></div></td></tr>';

		if($err2){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err2.'</font></div></td></tr>';
}

	echo '	<tr><td>Tarif </td> <td> : </td> <td><div class="input-field">
			<input id="input3" type="text" name="tarif" value="'.$tarif.'" /><label for="input3">Tarif</label></div></td></tr>';


		if($err3){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err3.'</font></div></td><tr>';
}




	echo '	<tr><td colspan="3"><center><button class="wow bounceInDown btn-floating btn-large waves-effect waves-light blue"
			data-container="body" data-toggle="popover" type="submit" data-wow-delay=".5s" data-placement="left" data-trigger="hover" data-content="Tambah Data">
			<i class="fa fa-plus"></i></button></form>
			<a href="index.php?p='.$p.'&act=view">
			<button class="wow bounceInDown btn-floating btn-large waves-effect waves-light red"
			data-container="body" data-toggle="popover" data-wow-delay="1s" data-placement="right" data-trigger="hover" data-content="Batal">
			<i class="fa fa-times"></i></button></a></center></td></tr></table>';

?>