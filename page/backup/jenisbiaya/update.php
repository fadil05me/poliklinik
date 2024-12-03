<?php

	$title	= 'Update Data';
	require_once $inc_dir.'head.php';
	$id		= cek($_GET['id']);
	$field	= 'idjenisbiaya';
		if($id){

	$get	= mysql_fetch_array(mysql_query('SELECT * FROM '.$p.' WHERE '.$field.'="'.dbres($id).'"'));
		if($get){

	$idjenisbiaya	= $_POST['idjenisbiaya'];
	$namabiaya		= $_POST['namabiaya'];
	$tarif			= $_POST['tarif'];



		if($_POST['submit'] == 'ok'){
	
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


	
			if (!$err1 && !$err2 && !$err3){
				
	$x		=	mysql_query('UPDATE '.$p.' SET idjenisbiaya="'.dbres($idjenisbiaya).'", 
				namabiaya="'.dbres($namabiaya).'", tarif="'.dbres($tarif).'" 
				WHERE idjenisbiaya="'.dbres($id).'"');

		if($x){
			
	echo '<meta http-equiv="Refresh" content="2; URL=index.php?p='.$p.'&act=view">';
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Berhasil Diupdate!</h2>';
	require_once $inc_dir.'foot.php';
	exit;
	}
	else {
		
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Gagal Diupdate!</h2>';
	}
	}
	}
	echo '	<table class="table table-bordered"><form method="post">';
	echo '	<tr><td> ID Jenis Biaya </td> <td> : </td> <td> <div class="input-field"><input id="input1" type="text" name="idjenisbiaya" value="'.$get['idjenisbiaya'].'" />
			<label for="input1">ID Jenis Biaya</label></div></td></tr>';
	
		if(isset($err1)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err1.'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Nama Biaya </td> <td> : </td> <td> <div class="input-field"><input id="input2" type="text" name="namabiaya" value="'.$get['namabiaya'].'" />
			<label for="input2">Nama Biaya</label></div></td></tr>';
		if(isset($err2)){
		echo '<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err2.'</font></div></td></tr>';
		
	}
		
	echo '	<tr><td> Tarif </td> <td> : </td> <td> <div class="input-field"><input id="input3" type="text" name="tarif" value="'.$get['tarif'].'" />
			<label for="input3">Tarif</label></div> </td></tr>';

		if(isset($err3)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err3.'</font></div></td></tr>';
	
	}

	
	echo '	<tr><td colspan="3"><center><input type="hidden" name="submit" value="ok" />
			<button class="wow bounceInDown btn-floating btn-large waves-effect waves-light blue" 
			data-container="body" data-toggle="popover" data-wow-delay=".5s" data-placement="left"
			data-trigger="hover" data-content="Update"><i class="fa fa-check-circle"></i></button></form>
			<a href="index.php?p='.$p.'&act=view" class="wow bounceInDown btn-floating btn-large waves-effect waves-light red" 
			data-container="body" data-toggle="popover" data-placement="right"
			data-trigger="hover" data-content="Batal" data-wow-delay="1s"><i class="fa fa-times-circle"></i></a>
			</center></td></tr></table>';
			
	}
	
	else {
	echo '<meta http-equiv="Refresh" content="2; URL=index.php?p='.$p.'&act=view">';
	echo '<h2 class="page-header">Data Tidak Ada!</h2>';
	
	}
	}
	else {
	header('location: index.php?p='.$p.'&act=view');
	
	}
?>