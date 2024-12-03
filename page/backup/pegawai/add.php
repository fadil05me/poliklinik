<?php

	//-- Config --//


	$title	= 'Tambah Data';
	
	require_once $inc_dir.'head.php';

	$nip			= $_POST['nip'];
	$namapeg		= $_POST['namapeg'];
	$almpeg			= $_POST['almpeg'];
	$telppeg		= $_POST['telppeg'];
	$tgllhrpeg		= $_POST['tgllhrpeg'];
	$jnskelpeg		= $_POST['jnskelpeg'];



	// -- Jika Sukses -- //
		if (isset($_GET['ok'])) {
	echo '<meta http-equiv="Refresh" content="2; URL=index.php?p='.$p.'&act=view">';
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Berhasil Ditambahkan!</h2>';
	require_once $inc_dir.'foot.php';
	exit;
}

	// -- Validasi --//
		if ($_POST['submit'] == 'ok') {
	
	
	// -- Validasi NIP -- //
	
			if(!$nip){
	$err1	= 'Harap Masukkan NIP!';

	}
	elseif(!is_numeric($nip)){
	$err1	= 'Hanya Boleh Diisi Dengan Angka!';

	}
	elseif (strlen(trim($nip))< 5) {
	$err1	= 'NIP Harus Diisi Min. 5 Karakter';

	}
	elseif (strlen(trim($nip))> 10) {
	$err1	= 'NIP Harus Diisi Max. 10 Karakter';
	
	}
	
	// -- Validasi Nama Pegawai --//
	
			if(!$namapeg){
	$err2	= 'Harap Masukkan Nama Pegawai!';

	}
	elseif (!preg_match("/^[a-zA-Z ]*$/",$namapeg)) {
	$err2	= 'Hanya Boleh Diisi Oleh Huruf dan Spasi';

	}
	elseif (strlen(trim($namapeg))<3) {
	$err2	= 'Nama Pegawai Harus Diisi Min. 3 Karakter';

	}
	elseif (strlen(trim($namapeg))>25) {
	$err2	= 'Nama Pegawai Harus Diisi Max. 25 Karakter';

	}

	// --  Validasi Alamat Pegawai -- //
			if(!$almpeg){
	$err3	= 'Harap Masukkan Alamat Pegawai!';
	
	}
	elseif (strlen(trim($almpeg))<5) {
	$err3	= 'Alamat Pegawai Harus Diisi Min. 5 Karakter';

	}
	elseif (strlen(trim($almpeg))>50) {
	$err3	= 'Alamat Pegawai Harus Diisi Max. 50 Karakter';

	}
	

	
	
	// -- Validasi Telpon Pegawai -- //
	
			if(!$telppeg){
	$err4	= 'Harap Masukkan No. Telpon Pegawai!';
	
	}
	elseif(!is_numeric($telppeg)){
	$err4	= 'Hanya Boleh Diisi Dengan Angka';
	}
	elseif (strlen(trim($telppeg))>15) {
	$err4	= 'No. Telpon Harus Diisi Max. 15 Karakter';
	
	}
	elseif (strlen(trim($telppeg))<5) {
	$err4	= 'No. Telpon Harus Diisi Min. 5 Karakter';
	
	}
	
	// -- Validasi Tanggal Lahir Pegawai -- //
	
	
			if(!$tgllhrpeg){
	$err5	= 'Harap Masukkan Tanggal Lahir Pegawai!';
	
	}
	
	
	// -- Validasi Jenis Kelamin Pegawai -- //
	
			if(!$jnskelpeg){
	$err6	= 'Harap Masukkan Jenis Kelamin Pegawai';
			
	}
	
	

	


	if(!$err1 && !$err2 && !$err3 && !$err4 && !$err5 && !$err6){
		$cek = mysql_query('SELECT nip FROM '.$p.' WHERE nip="'.dbres($nip).'"');
		if(mysql_num_rows($cek)>0){
	echo '<h6 class="page-header wow bounceIn" data-wow-delay=".7s"><font color="red">NIP Sudah Ada!</font></h6><br />';
		}
	else {		
			
		$x = mysql_query('INSERT INTO '.$p.' 
			VALUES("'.dbres($nip).'", "'.dbres($namapeg).'", 
			"'.dbres($almpeg).'", "'.dbres($telppeg).'", 
			"'.dbres(tglmysql($tgllhrpeg)).'", "'.dbres($jnskelpeg).'")');
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
	<tr><td>NIP </td> <td> : </td> <td><div class="input-field"><input id="input1" maxlength="10" type="text" name="nip" value="'.$nip.'" />
	<label for="input1">NIP</label></div></td></tr>';


		if($err1){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err1.'</font></div></td></tr>';
}


	echo '	<tr><td>Nama Pegawai </td> <td> : </td> <td><div class="input-field"><input id="input2" type="text" name="namapeg" maxlength="25" value="'.$namapeg.'" />
			<label for="input2">Nama Pegawai</label></div></td></tr>';

		if($err2){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err2.'</font></div></td></tr>';
}

	echo '	<tr><td>Alamat Pegawai </td> <td> : </td> <td><div class="input-field">
			<input id="input3" type="text" name="almpeg" value="'.$almpeg.'" maxlength="50" /><label for="input3">Alamat Pegawai</label></div></td></tr>';


		if($err3){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err3.'</font></div></td><tr>';
}

	echo '	<tr><td>Telpon Pegawai</td> <td> : </td> <td><div class="input-field"><input type="text" id="input4" maxlength="15" name="telppeg" value="'.$telppeg.'" />
			<label for="input4">Telpon Pegawai</label></div></td></tr>';


		if($err4){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err4.'</font></div></td><tr>';
}


	echo '	<tr><td>Tanggal Lahir Pegawai</td> <td> : </td> <td><div class="input-field"><input type="text" id="input5"
			name="tgllhrpeg" class="pikaday" value="'.$tgllhrpeg.'" />
			<label for="input5">Tanggal Lahir Pegawai</label></div></td></tr>';


		if($err5){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err5.'</font></div></td><tr>';
}



	echo '	<tr><td>Jenis Kelamin Pegawai</td> <td> : </td> <td><div class="input-field">
			<input name="jnskelpeg" value="L" type="radio" id="radio-gender-1" required />
			<label for="radio-gender-1">Laki - Laki</label>
			<input name="jnskelpeg" value="P" type="radio" id="radio-gender-2" />
			<label for="radio-gender-2">Perempuan</label></div></td></tr>';


		if($err6){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err6.'</font></div></td><tr>';
}





	echo '	<tr><td colspan="3"><center><button class="wow bounceInDown btn-floating btn-large waves-effect waves-light blue"
			data-container="body" data-toggle="popover" type="submit" data-wow-delay=".5s" data-placement="left" data-trigger="hover" data-content="Tambah Data">
			<i class="fa fa-plus"></i></button></form>
			<a href="index.php?p='.$p.'&act=view">
			<button class="wow bounceInDown btn-floating btn-large waves-effect waves-light red"
			data-container="body" data-toggle="popover" data-wow-delay="1s" data-placement="right" data-trigger="hover" data-content="Batal">
			<i class="fa fa-times"></i></button></a></center></td></tr></table>';

?>