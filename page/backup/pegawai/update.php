<?php

	$title	= 'Update Data';
	require_once $inc_dir.'head.php';
	$id		= cek($_GET['id']);
	$field	= 'nip';
		if($id){

	$get	= mysql_fetch_array(mysql_query('SELECT * FROM '.$p.' WHERE '.$field.'="'.dbres($id).'"'));
		if($get){

	$nip			= $_POST['nip'];
	$namapeg		= $_POST['namapeg'];
	$almpeg			= $_POST['almpeg'];
	$telppeg		= $_POST['telppeg'];
	$tgllhrpeg		= $_POST['tgllhrpeg'];
	$jnskelpeg		= $_POST['jnskelpeg'];
	$tglregistrasi	= $_POST['tglregistrasi'];



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
	
	
	// -- Validasi Tanggal Registrasi -- //
	
				if(!$tglregistrasi){
	$err7	= 'Harap Masukkan Tanggal Registrasi';
	}

	
			if (!$err1 && !$err2 && !$err3 && !$err4){
				
	$x		=	mysql_query('UPDATE '.$p.' SET nip="'.dbres($nip).'", 
				namapeg="'.dbres($namapeg).'", almpeg="'.dbres($almpeg).'", telppeg="'.dbres($telppeg).'", 
				tgllhrpeg="'.dbres(tglmysql($tgllhrpeg)).'", jnskelpeg="'.dbres($jnskelpeg).'"
				WHERE nip="'.dbres($id).'"');

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
	echo '	<tr><td> NIP </td> <td> : </td> <td> <div class="input-field"><input id="input1" type="text" name="nip" value="'.$get['nip'].'" />
			<label for="input1">NIP</label></div></td></tr>';
	
		if(isset($err1)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err1.'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Nama Pegawai </td> <td> : </td> <td> <div class="input-field"><input id="input2" type="text" name="namapeg" value="'.$get['namapeg'].'" />
			<label for="input2">Nama Pegawai</label></div></td></tr>';
		if(isset($err2)){
		echo '<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err2.'</font></div></td></tr>';
		
	}
		
	echo '	<tr><td> Alamat Pegawai </td> <td> : </td> <td> <div class="input-field"><input id="input3" type="text" name="almpeg" value="'.$get['almpeg'].'" />
			<label for="input3">Alamat Pegawai</label></div> </td></tr>';

		if(isset($err3)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err3.'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Telpon Pegawai </td> <td> : </td> <td> <div class="input-field"><input id="input4" type="text" name="telppeg" 
			value="'.$get['telppeg'].'" />
			<label for="input4">Telpon Pegawai</label></div> </td></tr>';

		if(isset($err4)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err4.'</font></div></td></tr>';
	
	}
	

	echo '	<tr><td>Tanggal Lahir Pegawai</td> <td> : </td> <td><div class="input-field"><input name="tgllhrpeg" class="pikaday" type="text" id="input5"
			value="'.$get['tgllhrpeg'].'">
			<label for="input5">Tanggal Lahir Pegawai</label></div></td></tr>';


		if($err5){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err5.'</font></div></td><tr>';
	}

		if($get['jnskelpeg'] == 'L'){
			$ac = 'checked';
		}
		else{
			$ac='';
		}
		
				if($get['jnskelpeg'] == 'P'){
			$ax = 'checked';
		}
		else{
			$ax='';
		}

	echo '	<tr><td>Jenis Kelamin Pegawai</td> <td> : </td> <td><div class="input-field">
			<input name="jnskelpeg" value="L" type="radio" id="radio-gender-1" required '.$ac.' />
			<label for="radio-gender-1">Laki - Laki</label>
			<input name="jnskelpeg" value="P" type="radio" id="radio-gender-2" '.$ax.' />
			<label for="radio-gender-2">Perempuan</label></div></td></tr>';


		if($err6){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err6.'</font></div></td><tr>';
	}



	echo '	<tr><td>Tanggal Registrasi</td> <td> : </td> <td><div class="input-field"><input type="text" id="input7"
			name="tglregistrasi" class="pikaday" value="'.$get['tglregistrasi'].'" />
			<label for="input7">Tanggal Registrasi</label></div></td></tr>';


		if($err7){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err7.'</font></div></td><tr>';
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