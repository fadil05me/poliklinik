<?php

	$title	= 'Update Data';
	require_once $inc_dir.'head.php';
	$id		= cek($_GET['id']);
	$field	= 'Nopasien';
		if($id){

	$get	= mysql_fetch_array(mysql_query('SELECT * FROM '.$p.' WHERE '.$field.'="'.dbres($id).'"'));
		if($get){

	$Nopasien		= $_POST['Nopasien'];
	$Namapas		= $_POST['Namapas'];
	$almpas			= $_POST['almpas'];
	$telppas		= $_POST['telppas'];
	$tgllahirpas	= $_POST['tgllahirpas'];
	$jeniskelpas	= $_POST['jeniskelpas'];
	$tglregistrasi	= $_POST['tglregistrasi'];



	// -- Validasi --//
		if ($_POST['submit'] == 'ok') {
	
	
	// -- Validasi No. Pasien -- //
	
			if(!$Nopasien){
	$err1	= 'Harap Masukkan No. Pasien!';

	}
	elseif(!is_numeric($Nopasien)){
	$err1	= 'Hanya Boleh Diisi Dengan Angka!';

	}
	elseif (strlen(trim($Nopasien))< 5) {
	$err1	= 'No. Pasien Harus Diisi Min. 5 Karakter';

	}
	elseif (strlen(trim($Nopasien))> 10) {
	$err1	= 'No. Pasien Harus Diisi Max. 10 Karakter';
	
	}
	
	// -- Validasi Nama Pasien --//
	
			if(!$Namapas){
	$err2	= 'Harap Masukkan Nama Pasien!';

	}
	elseif (!preg_match("/^[a-zA-Z ]*$/",$Namapas)) {
	$err2	= 'Hanya Boleh Diisi Oleh Huruf dan Spasi';

	}
	elseif (strlen(trim($Namapas))<3) {
	$err2	= 'Nama Pasien Harus Diisi Min. 3 Karakter';

	}
	elseif (strlen(trim($Namapas))>25) {
	$err2	= 'Nama Pasien Harus Diisi Max. 25 Karakter';

	}

	// --  Validasi Alamat Pasien -- //
			if(!$almpas){
	$err3	= 'Harap Masukkan Alamat Pasien!';
	
	}
	elseif (strlen(trim($almpas))<5) {
	$err3	= 'Alamat Pasien Harus Diisi Min. 5 Karakter';

	}
	elseif (strlen(trim($almpas))>50) {
	$err3	= 'Alamat Pasien Harus Diisi Max. 50 Karakter';

	}
	

	
	
	// -- Validasi Telpon Pasien -- //
	
			if(!$telppas){
	$err4	= 'Harap Masukkan No. Telpon Pasien!';
	
	}
	elseif(!is_numeric($telppas)){
	$err4	= 'Hanya Boleh Diisi Dengan Angka';
	}
	elseif (strlen(trim($telppas))>15) {
	$err4	= 'No. Telpon Harus Diisi Max. 15 Karakter';
	
	}
	elseif (strlen(trim($telppas))<5) {
	$err4	= 'No. Telpon Harus Diisi Min. 5 Karakter';
	
	}
	
	// -- Validasi Tanggal Lahir Pasien -- //
	
	
			if(!$tgllahirpas){
	$err5	= 'Harap Masukkan Tanggal Lahir Pasien!';
	
	}
	
	
	// -- Validasi Jenis Kelamin Pasien -- //
	
			if(!$jeniskelpas){
	$err6	= 'Harap Masukkan Jenis Kelamin Pasien';
			
	}
	
	
	// -- Validasi Tanggal Registrasi -- //
	
				if(!$tglregistrasi){
	$err7	= 'Harap Masukkan Tanggal Registrasi';
	}

	
			if (!$err1 && !$err2 && !$err3 && !$err4){
				
	$x		=	mysql_query('UPDATE '.$p.' SET Nopasien="'.dbres($Nopasien).'", 
				Namapas="'.dbres($Namapas).'", almpas="'.dbres($almpas).'", telppas="'.dbres($telppas).'", 
				tgllahirpas="'.dbres(tglmysql($tgllahirpas)).'", jeniskelpas="'.dbres($jeniskelpas).'", tglregistrasi="'.dbres(tglmysql($tglregistrasi)).'"
				WHERE Nopasien="'.dbres($id).'"');

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
	echo '	<tr><td> No. Pasien </td> <td> : </td> <td> <div class="input-field"><input id="input1" type="text" name="Nopasien" value="'.$get['Nopasien'].'" />
			<label for="input1">No. Pasien</label></div></td></tr>';
	
		if(isset($err1)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err1.'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Nama Pasien </td> <td> : </td> <td> <div class="input-field"><input id="input2" type="text" name="Namapas" value="'.$get['Namapas'].'" />
			<label for="input2">Nama Pasien</label></div></td></tr>';
		if(isset($err2)){
		echo '<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err2.'</font></div></td></tr>';
		
	}
		
	echo '	<tr><td> Alamat Pasien </td> <td> : </td> <td> <div class="input-field"><input id="input3" type="text" name="almpas" value="'.$get['almpas'].'" />
			<label for="input3">Alamat Pasien</label></div> </td></tr>';

		if(isset($err3)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err3.'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Telpon Pasien </td> <td> : </td> <td> <div class="input-field"><input id="input4" type="text" name="telppas" 
			value="'.$get['telppas'].'" />
			<label for="input4">Telpon Pasien</label></div> </td></tr>';

		if(isset($err4)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err4.'</font></div></td></tr>';
	
	}
	

	echo '	<tr><td>Tanggal Lahir Pasien</td> <td> : </td> <td><div class="input-field"><input name="tgllahirpas" class="pikaday" type="text" id="input5"
			value="'.$get['tgllahirpas'].'">
			<label for="input5">Tanggal Lahir Pasien</label></div></td></tr>';


		if($err5){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err5.'</font></div></td><tr>';
	}

		if($get['jeniskelpas'] == 'L'){
			$ac = 'checked';
		}
		else{
			$ac='';
		}
		
				if($get['jeniskelpas'] == 'P'){
			$ax = 'checked';
		}
		else{
			$ax='';
		}

	echo '	<tr><td>Jenis Kelamin Pasien</td> <td> : </td> <td><div class="input-field">
			<input name="jeniskelpas" value="L" type="radio" id="radio-gender-1" required '.$ac.' />
			<label for="radio-gender-1">Laki - Laki</label>
			<input name="jeniskelpas" value="P" type="radio" id="radio-gender-2" '.$ax.' />
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