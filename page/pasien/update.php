<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');

	$title	= 'Update Data';
	require_once $inc_dir.'head.php';
	$id		= cek($_GET['id']);
	$field	= 'Nopasien';
		if($id){

	$get	= mysql_fetch_array(mysql_query('SELECT * FROM '.$p.' WHERE '.$field.'="'.dbres($id).'"'));
		if($get){

	$Namapas		= $_POST['Namapas'];
	$almpas			= $_POST['almpas'];
	$telppas		= $_POST['telppas'];
	$tgllahirpas	= $_POST['tgllahirpas'];
	$jeniskelpas	= $_POST['jeniskelpas'];




	// -- Validasi --//
		if ($_POST['submit'] == 'ok') {
	
		
	// -- Validasi Nama Pasien --//
	
			if(!$Namapas){
	$err['Namapas']	= 'Harap Masukkan Nama Pasien!';

	}
	elseif (!preg_match("/^[a-zA-Z ]*$/",$Namapas)) {
	$err['Namapas']	= 'Hanya Boleh Diisi Oleh Huruf dan Spasi';
	
	}
	elseif (strlen(trim($Namapas))<3) {
	$err['Namapas']	= 'Nama Pasien Harus Diisi Min. 3 Karakter';
	
	}
	elseif (strlen(trim($Namapas))>25) {
	$err['Namapas']	= 'Nama Pasien Harus Diisi Max. 25 Karakter';
	
	}

	// --  Validasi Alamat Pasien -- //
			if(!$almpas){
	$err['almpas']	= 'Harap Masukkan Alamat Pasien!';
	
	}
	elseif (strlen(trim($almpas))<5) {
	$err['almpas']	= 'Alamat Pasien Harus Diisi Min. 5 Karakter';
	
	}
	elseif (strlen(trim($almpas))>50) {
	$err['almpas']	= 'Alamat Pasien Harus Diisi Max. 50 Karakter';
	
	}
	
	
	
	
	// -- Validasi Telpon Pasien -- //
	
			if(!$telppas){
	$err['telppas']	= 'Harap Masukkan No. Telpon Pasien!';
	
	}
	elseif(!is_numeric($telppas)){
	$err['telppas']	= 'Hanya Boleh Diisi Dengan Angka';
	}
	elseif (strlen(trim($telppas))>15) {
	$err['telppas']	= 'No. Telpon Harus Diisi Max. 15 Karakter';
	
	}
	elseif (strlen(trim($telppas))<5) {
	$err['telppas']	= 'No. Telpon Harus Diisi Min. 5 Karakter';
	
	}
	

	
	// -- Validasi Jenis Kelamin Pasien -- //
	
			if(!$jeniskelpas){
	$err['jeniskelpas']	= 'Harap Masukkan Jenis Kelamin Pasien';
			
	}
	
	
	
			if (!$err){
				
	$x		=	mysql_query('UPDATE '.$p.' SET 
				Namapas="'.dbres($Namapas).'", almpas="'.dbres($almpas).'", telppas="'.dbres($telppas).'", 
				tgllahirpas="'.dbres(FlipDate($tgllahirpas, 'ymd')).'", jeniskelpas="'.dbres($jeniskelpas).'"
				WHERE Nopasien="'.dbres($id).'"');

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
	echo '
<script type="text/javascript">
	$(document).ready(function(){
		var picker = new Pikaday({
			field: $(\'#tgl_lahir\')[0],
			format: \'DD-MM-YYYY\',
			i18n: {
				months : [\'Januari\',\'Februari\',\'Maret\',\'April\',\'Mei\',\'Juni\',\'Juli\',\'Agustus\',\'September\',\'Oktober\',\'November\',\'Desember\'],
				weekdays  : [\'Minggu\',\'Senin\',\'Selasa\',\'Rabu\',\'Kamis\',\'Jumat\',\'Sabtu\'],
				weekdaysShort : [\'M\',\'S\',\'S\',\'R\',\'K\',\'J\',\'S\']
			},
			maxDate: moment().subtract({days: 1}).toDate(),
			yearRange: 50
		});
		});
</script>

	
	<table class="table table-bordered"><form method="post">';
	echo '	<tr><td> Kode Pasien </td> <td> : </td> <td> <div class="input-field">
			<input id="input1" type="text" name="Nopasien" value="'.$get['Nopasien'].'" disabled/>
			<label for="input1">Kode Pasien</label></div></td></tr>';
	

	
	echo '	<tr><td> Nama Pasien </td> <td> : </td> <td> <div class="input-field">
			<input id="input2" type="text" name="Namapas" value="'.$get['Namapas'].'" />
			<label for="input2">Nama Pasien</label></div></td></tr>';
			
		if($err['Namapas']){
		echo '<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['Namapas'].'</font></div></td></tr>';
		
	}
		
	echo '	<tr><td> Alamat Pasien </td> <td> : </td> <td> <div class="input-field"><input id="input3" type="text" name="almpas" value="'.$get['almpas'].'" />
			<label for="input3">Alamat Pasien</label></div> </td></tr>';

		if($err['almpas']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['almpas'].'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Telpon Pasien </td> <td> : </td> <td> <div class="input-field"><input id="input4" type="text" name="telppas" 
			value="'.$get['telppas'].'" />
			<label for="input4">Telpon Pasien</label></div> </td></tr>';

		if($err['telppas']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['telppas'].'</font></div></td></tr>';
	
	}
	

	echo '	<tr><td>Tanggal Lahir Pasien</td> <td> : </td> <td><div class="input-field"><input name="tgllahirpas" type="text" id="tgl_lahir"
			value="'.FlipDate($get['tgllahirpas'], 'dmy').'">
			<label for="tgl_lahir">Tanggal Lahir Pasien</label></div></td></tr>';


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


		if($err['jeniskelpas']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['jeniskelpas'].'</font></div></td><tr>';
	}



	echo '	<tr><td>Tanggal Registrasi</td> <td> : </td> <td><div class="input-field"><input type="text" id="tgl_reg"
			name="tglregistrasi" value="'.FlipDate($get['tglregistrasi'], 'dmy').'" disabled/>
			<label for="tgl_reg">Tanggal Registrasi</label></div></td></tr>';


	
	echo '	<tr><td colspan="3"><center><input type="hidden" name="submit" value="ok" />
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
