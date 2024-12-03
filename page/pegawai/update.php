<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');


	$title	= 'Update Data';
	require_once $inc_dir.'head.php';
	$id		= cek($_GET['id']);
	$field	= 'nip';
		if($id){

	$get	= mysql_fetch_array(mysql_query('SELECT * FROM '.$p.' WHERE '.$field.'="'.dbres($id).'"'));
		if($get){


	$namapeg		= $_POST['namapeg'];
	$almpeg			= $_POST['almpeg'];
	$telppeg		= $_POST['telppeg'];
	$tgllhrpeg		= $_POST['tgllhrpeg'];
	$jnskelpeg		= $_POST['jnskelpeg'];
	$tglregistrasi	= $_POST['tglregistrasi'];



	// -- Validasi --//
		if ($_POST['submit'] == 'ok') {
	

	
	// -- Validasi Nama Pegawai --//
	
			if(!$namapeg){
	$err['namapeg']	= 'Harap Masukkan Nama Pegawai!';

	}
	elseif (!preg_match("/^[a-zA-Z ]*$/",$namapeg)) {
	$err['namapeg']	= 'Hanya Boleh Diisi Oleh Huruf dan Spasi';

	}
	elseif (strlen(trim($namapeg))<3) {
	$err['namapeg']	= 'Nama Pegawai Harus Diisi Min. 3 Karakter';

	}
	elseif (strlen(trim($namapeg))>25) {
	$err['namapeg']	= 'Nama Pegawai Harus Diisi Max. 25 Karakter';

	}

	// --  Validasi Alamat Pegawai -- //
			if(!$almpeg){
	$err['almpeg']	= 'Harap Masukkan Alamat Pegawai!';
	
	}
	elseif (strlen(trim($almpeg))<5) {
	$err['almpeg']	= 'Alamat Pegawai Harus Diisi Min. 5 Karakter';

	}
	elseif (strlen(trim($almpeg))>50) {
	$err['almpeg']	= 'Alamat Pegawai Harus Diisi Max. 50 Karakter';

	}
	

	
	
	// -- Validasi Telpon Pegawai -- //
	
			if(!$telppeg){
	$err['telppeg']	= 'Harap Masukkan No. Telpon Pegawai!';
	
	}
	elseif(!is_numeric($telppeg)){
	$err['telppeg']	= 'Hanya Boleh Diisi Dengan Angka';
	}
	elseif (strlen(trim($telppeg))>15) {
	$err['telppeg']	= 'No. Telpon Harus Diisi Max. 15 Karakter';
	
	}
	elseif (strlen(trim($telppeg))<5) {
	$err['telppeg']	= 'No. Telpon Harus Diisi Min. 5 Karakter';
	
	}
	
	// -- Validasi Tanggal Lahir Pegawai -- //
	
	
			if(!$tgllhrpeg){
	$err['tgllhrpeg']	= 'Harap Masukkan Tanggal Lahir Pegawai!';
	
	}
	
	elseif(vthn($tgllhrpeg) > 1997){
	$err['tgllhrpeg']	= 'Min. 18 thn!';
	
	}
	elseif(vthn($tgllhrpeg) < 1966){
	$err['tgllhrpeg']	= 'Max. 50 thn!';
	
	}
	
	
	// -- Validasi Jenis Kelamin Pegawai -- //
	
			if(!$jnskelpeg){
	$err['jnskelpeg']	= 'Harap Masukkan Jenis Kelamin Pegawai';
			
	}
	

	
			if (!$err){
				
	$x		=	mysql_query('UPDATE '.$p.' SET
				namapeg="'.dbres($namapeg).'", almpeg="'.dbres($almpeg).'", telppeg="'.dbres($telppeg).'", 
				tgllhrpeg="'.dbres(FlipDate($tgllhrpeg, 'ymd')).'", jnskelpeg="'.dbres($jnskelpeg).'"
				WHERE nip="'.dbres($id).'"');

		if($x){
	set_my_messages_to_user('Data Berhasil Diupdate!');
	redirect('index.php?p='.$p.'&act=view');
	exit;
	}
	else {
		
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Gagal Diupdate!</h2>';
	}
	}
	}
	echo '	<table class="table table-bordered"><form method="post">';
	echo '	<tr><td> NIP </td> <td> : </td> <td> <div class="input-field">
			<input id="input1" type="text" name="nip" value="'.$get['nip'].'" disabled/>
			<label for="input1">NIP</label></div></td></tr>';
	
		if($err['nip']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['nip'].'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Nama Pegawai </td> <td> : </td> <td> <div class="input-field"><input id="input2" type="text" name="namapeg" value="'.$get['namapeg'].'" />
			<label for="input2">Nama Pegawai</label></div></td></tr>';
		if($err['namapeg']){
		echo '<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['namapeg'].'</font></div></td></tr>';
		
	}
		
	echo '	<tr><td> Alamat Pegawai </td> <td> : </td> <td> <div class="input-field"><input id="input3" type="text" name="almpeg" value="'.$get['almpeg'].'" />
			<label for="input3">Alamat Pegawai</label></div> </td></tr>';

		if($err['almpeg']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['almpeg'].'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Telpon Pegawai </td> <td> : </td> <td> <div class="input-field"><input id="input4" type="text" name="telppeg" 
			value="'.$get['telppeg'].'" />
			<label for="input4">Telpon Pegawai</label></div> </td></tr>';

		if($err['telppeg']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['telppeg'].'</font></div></td></tr>';
	
	}
	

	echo '	<tr><td>Tanggal Lahir Pegawai</td> <td> : </td> <td><div class="input-field"><input name="tgllhrpeg" type="text" id="tgl_lahir"
			value="'.FlipDate($get['tgllhrpeg'], 'dmy').'">
			<label for="tgl_lahir">Tanggal Lahir Pegawai</label></div></td></tr>';


		if($err['tgllhrpeg']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['tgllhrpeg'].'</font></div></td><tr>';
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


		if($err['jnskelpeg']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['jnskelpeg'].'</font></div></td><tr>';
	}


	
	echo '	<tr><td colspan="3"><center>
			<input type="hidden" name="submit" value="ok" />
			<button class="btn btn-primary">
			<i class="fa fa-check-circle"> Update</i>
			</button></form>
			<a href="index.php?p='.$p.'&act=view" class="btn btn-danger red">
			<i class="fa fa-times-circle"> Batal</i></a>
			</center></td></tr></table>';
			
	}
	
	else {
		set_my_messages_to_user('Data Tidak Ada!');
		redirect('index.php?p='.$p.'&act=view');
		exit;
	
	}
	}
	else {
	redirect('index.php?p='.$p.'&act=view');
	
	}
?>

<script type="text/javascript">
	$(document).ready(function(){
		var picker = new Pikaday({
			field: $('#tgl_lahir')[0],
			format: 'DD-MM-YYYY',
			i18n: {
				months : ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
				weekdays  : ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'],
				weekdaysShort : ['M','S','S','R','K','J','S']
			},
			maxDate: moment().subtract({years: 20}).toDate(),
			yearRange: 50
		});
	});
</script>