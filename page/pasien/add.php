<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');

	//-- Config --//


	$title	= 'Tambah Data';
	
	require_once $inc_dir.'head.php';

	$Namapas		= $_POST['Namapas'];
	$almpas			= $_POST['almpas'];
	$telppas		= $_POST['telppas'];
	$tgllahirpas	= $_POST['tgllahirpas'];
	$jeniskelpas	= $_POST['jeniskelpas'];
	
	$cex	= hitungdata('SELECT Nopasien, COUNT(Nopasien) AS jumlahdata FROM '.$p);
	if($cex < 1){
		$Nopasien = 'PS10001';
	}
	else{
	$cex = mysql_fetch_array(mysql_query('SELECT Nopasien FROM '.$p.' ORDER BY urutan DESC LIMIT 0, 1'));
	$Nopasien	= str_replace('PS', '', $cex['Nopasien']);
	$Nopasien	= $Nopasien+1;
	$Nopasien	= 'PS'.$Nopasien;
	}
	
	


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
	
	// -- Validasi Tanggal Lahir Pasien -- //
	
	
			if(!$tgllahirpas){
	$err['tgllahirpas']	= 'Harap Masukkan Tanggal Lahir Pasien!';
	
	}
	
	
	// -- Validasi Jenis Kelamin Pasien -- //
	
			if(!$jeniskelpas){
	$err['jeniskelpas']	= 'Harap Masukkan Jenis Kelamin Pasien';
			
	}
	
	
	// -- Validasi Tanggal Registrasi -- //



	if(!$err){
		$cek = mysql_query('SELECT Nopasien FROM '.$p.' WHERE Nopasien="'.dbres($Nopasien).'"');
		if(mysql_num_rows($cek)>0){
	echo '<h6 class="page-header wow bounceIn" data-wow-delay=".7s"><font color="red">No. Pasien Sudah Ada!</font></h6><br />';
		}
	else {		
			
		$x = mysql_query('INSERT INTO '.$p.' 
			VALUES("'.dbres($Nopasien).'", "'.dbres($Namapas).'", 
			"'.dbres($almpas).'", "'.dbres($telppas).'", 
			"'.dbres(FlipDate($tgllahirpas, 'ymd')).'", "'.dbres($jeniskelpas).'", 
			"'.dbres(date('Y-m-d')).'", "")');
	if($x){
	set_my_messages_to_user('Data Berhasil Ditambahkan!');
	redirect('index.php?p=pendaftaran&act=add&id='.$Nopasien);
	exit;
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
	<tr><td>Kode Pasien </td> <td> : </td> <td><div class="input-field"><input id="input1" maxlength="10" type="text" name="Nopasien" value="'.$Nopasien.'" disabled/>
	<label for="input1">Kode Pasien</label></div></td></tr>';


		if($err['Nopasien']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['Nopasien'].'</font></div></td></tr>';
}


	echo '	<tr><td>Nama Pasien </td> <td> : </td> <td><div class="input-field"><input id="input2" type="text" name="Namapas" maxlength="25" value="'.$Namapas.'" />
			<label for="input2">Nama Pasien</label></div></td></tr>';

		if($err['Namapas']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['Namapas'].'</font></div></td></tr>';
}

	echo '	<tr><td>Alamat Pasien </td> <td> : </td> <td><div class="input-field">
			<input id="input3" type="text" name="almpas" value="'.$almpas.'" maxlength="50" /><label for="input3">Alamat Pasien</label></div></td></tr>';


		if($err['almpas']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['almpas'].'</font></div></td><tr>';
}

	echo '	<tr><td>Telpon Pasien</td> <td> : </td> <td><div class="input-field"><input type="text" id="input4" maxlength="15" name="telppas" value="'.$telppas.'" />
			<label for="input4">Telpon Pasien</label></div></td></tr>';


		if($err['telppas']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['telppas'].'</font></div></td><tr>';
}


	echo '	<tr><td>Tanggal Lahir Pasien</td> <td> : </td> <td><div class="input-field"><input type="text" id="tgl_lahir"
			name="tgllahirpas" value="'.$tgllahirpas.'" />
			<label for="tgl_lahir">Tanggal Lahir Pasien</label></div></td></tr>';


		if($err['tgllahirpas']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['tgllahirpas'].'</font></div></td><tr>';
}

		if($jeniskelpas == 'L'){
			$ac = 'checked';
		}
		else{
			$ac='';
		}
		
				if($jeniskelpas == 'P'){
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
			name="tglregistrasi" value="'.date('d-m-Y').'" disabled/>
			<label for="tgl_reg">Tanggal Registrasi</label></div></td></tr>';





	echo '	<tr><td colspan="3"><center><button class="btn btn-primary">
			<i class="fa fa-plus"> Tambah</i></button></form>
			<a href="index.php?p='.$p.'&act=view">
			<button class="btn btn-danger red">
			<i class="fa fa-times"> Batal</i></button></a></center></td></tr></table>';

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
			maxDate: moment().subtract({days: 0}).toDate(),
			yearRange: 50
		});
	});
</script>
