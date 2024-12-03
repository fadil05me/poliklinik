<?php

	$title	= 'Update Data';
	require_once $inc_dir.'head.php';
	$id		= cek($_GET['id']);
	$field	= 'kodejadwal';
		if($id){

	$get	= mysql_fetch_array(mysql_query('SELECT * FROM '.$p.' WHERE '.$field.'="'.dbres($id).'"'));
		if($get){

	$kodejadwal	= $_POST['kodejadwal'];
	$hari		= $_POST['hari'];
	$jammulai	= $_POST['jammulai'];
	$jamselesai	= $_POST['jamselesai'];



		if($_POST['submit'] == 'ok'){
	
	// -- Validasi Kode Jadwal -- //
	
			if(!$kodejadwal){
	$err1	= 'Harap Masukkan Kode Jadwal!';

	}
	elseif(!is_numeric($kodejadwal)){
	$err1	= 'Hanya Boleh Diisi Dengan Angka!';

	}
	elseif (strlen(trim($kodejadwal))< 5) {
	$err1	= 'Kode Jadwal Harus Diisi 5 Angka';

	}
	elseif (strlen(trim($kodejadwal))> 5) {
	$err1	= 'Kode Jadwal Harus Diisi 5 Angka';

	}
	
	// -- Validasi Hari --//
	
			if(!$hari){
	$err2	= 'Harap Masukkan Hari!';

	}
	elseif (!preg_match("/^[a-zA-Z ]*$/",$hari)) {
	$err2	= 'Hanya Boleh Diisi Oleh Huruf dan Spasi';

	}
	elseif (strlen(trim($hari))<3) {
	$err2	= 'Hari Harus Diisi Min. 3 Digit';

	}
	elseif (strlen(trim($hari))>25) {
	$err2	= 'Hari Harus Diisi Max. 25 Digit';

	}

	// --  Validasi Jam Mulai -- //
			if(!$jammulai){
	$err3	= 'Harap Masukkan Jam Mulai!';
	
	}
	elseif (strlen(trim($jammulai))<5) {
	$err3	= 'Jam Mulai Harus Diisi Min. 5 Digit';

	}
	elseif (strlen(trim($jammulai))>50) {
	$err3	= 'Jam Mulai Harus Diisi Max. 50 Digit';

	}
	

	
	
	// -- Validasi Jam Selesai -- //
	
			if(!$jamselesai){
	$err4	= 'Harap Masukkan No. Jam Selesai!';
	
	}
	elseif(!is_numeric($jamselesai)){
	$err4	= 'Hanya Boleh Diisi Dengan Angka';
	}
	elseif (strlen(trim($jamselesai))>15) {
	$err4	= 'No. Telpon Harus Diisi Max. 15 Digit';
	
	}
	elseif (strlen(trim($jamselesai))<5) {
	$err4	= 'No. Telpon Harus Diisi Min. 5 Digit';
	
	}

	
			if (!$err1 && !$err2 && !$err3 && !$err4){
				
	$x		=	mysql_query('UPDATE '.$p.' SET kodejadwal="'.dbres($kodejadwal).'", 
				hari="'.dbres($hari).'", jammulai="'.dbres($jammulai).'", jamselesai="'.dbres($jamselesai).'" 
				WHERE kodejadwal="'.dbres($id).'"');

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
	echo '	<tr><td> Kode Jadwal </td> <td> : </td> <td> <div class="input-field"><input id="input1" type="text" name="kodejadwal" value="'.$get['kodejadwal'].'" />
			<label for="input1">Kode Jadwal</label></div></td></tr>';
	
		if(isset($err1)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err1.'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Hari </td> <td> : </td> <td> <div class="input-field"><input id="input2" type="text" name="hari" value="'.$get['hari'].'" />
			<label for="input2">Hari</label></div></td></tr>';
		if(isset($err2)){
		echo '<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err2.'</font></div></td></tr>';
		
	}
		
	echo '	<tr><td> Jam Mulai </td> <td> : </td> <td> <div class="input-field"><input id="input3" type="text" name="jammulai" value="'.$get['jammulai'].'" />
			<label for="input3">Jam Mulai</label></div> </td></tr>';

		if(isset($err3)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err3.'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Jam Selesai </td> <td> : </td> <td> <div class="input-field"><input id="input4" type="text" name="jamselesai" 
			value="'.$get['jamselesai'].'" />
			<label for="input4">Jam Selesai</label></div> </td></tr>';

		if(isset($err4)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err4.'</font></div></td></tr>';
	
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