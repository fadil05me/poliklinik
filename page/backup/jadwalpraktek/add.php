<?php

	//-- Config --//


	$title	= 'Tambah Data';
	
	require_once $inc_dir.'head.php';

	$kodejadwal	= $_POST['kodejadwal'];
	$hari		= $_POST['hari'];
	$jammulai	= $_POST['jammulai'];
	$jamselesai	= $_POST['jamselesai'];


	// -- Jika Sukses -- //
		if (isset($_GET['ok'])) {
	echo '<meta http-equiv="Refresh" content="2; URL=index.php?p='.$p.'&act=view">';
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Berhasil Ditambahkan!</h2>';
	require_once $inc_dir.'foot.php';
	exit;
}

	// -- Validasi --//
		if ($_POST['submit'] == 'ok') {
	
	
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
	


	if(!$err1 && !$err2 && !$err4 && !$err3){
		$cek = mysql_query('SELECT kodejadwal FROM '.$p.' WHERE kodejadwal="'.dbres($kodejadwal).'"');
		if(mysql_num_rows($cek)>0){
	echo '<h6 class="page-header wow bounceIn" data-wow-delay=".7s"><font color="red">Kode Jadwal Sudah Ada!</font></h6><br />';
		}
	else {		
			
		$x = mysql_query('INSERT INTO '.$p.' 
			VALUES("'.dbres($kodejadwal).'", "'.dbres($hari).'", 
			"'.dbres($jammulai).'", "'.dbres($jamselesai).'")');
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
	<tr><td>Kode Jadwal </td> <td> : </td> <td><div class="input-field"><input id="input1" type="text" name="kodejadwal" value="'.$kodejadwal.'" />
	<label for="input1">Kode Jadwal</label></div></td></tr>';


		if($err1){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err1.'</font></div></td></tr>';
}


	echo '	<tr><td>Hari </td> <td> : </td> <td><div class="input-field"><input id="input2" type="text" name="hari" value="'.$hari.'" />
			<label for="input2">Hari</label></div></td></tr>';

		if($err2){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err2.'</font></div></td></tr>';
}

	echo '	<tr><td>Jam Mulai </td> <td> : </td> <td><div class="input-field">
			<input id="input3" type="text" name="jammulai" value="'.$jammulai.'" /><label for="input3">Jam Mulai</label></div></td></tr>';


		if($err3){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err3.'</font></div></td><tr>';
}

	echo '	<tr><td>Jam Selesai</td> <td> : </td> <td><div class="input-field"><input type="text" id="input4" name="jamselesai" value="'.$jamselesai.'" />
			<label for="input4">Jam Selesai</label></div></td></tr>';


if($err4){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err4.'</font></div></td><tr>';
}


	echo '	<tr><td colspan="3"><center><button class="wow bounceInDown btn-floating btn-large waves-effect waves-light blue"
			data-container="body" data-toggle="popover" type="submit" data-wow-delay=".5s" data-placement="left" data-trigger="hover" data-content="Tambah Data">
			<i class="fa fa-plus"></i></button></form>
			<a href="index.php?p='.$p.'&act=view">
			<button class="wow bounceInDown btn-floating btn-large waves-effect waves-light red"
			data-container="body" data-toggle="popover" data-wow-delay="1s" data-placement="right" data-trigger="hover" data-content="Batal">
			<i class="fa fa-times"></i></button></a></center></td></tr></table>';

?>