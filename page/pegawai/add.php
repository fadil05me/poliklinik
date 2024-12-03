<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');

	//-- Config --//
	$title	= 'Tambah Data';
	require_once $inc_dir.'head.php';

	$namapeg		= $_POST['namapeg'];
	$almpeg			= $_POST['almpeg'];
	$telppeg		= $_POST['telppeg'];
	$tgllhrpeg		= $_POST['tgllhrpeg'];
	$jnskelpeg		= $_POST['jnskelpeg'];
	
	
	$cex = hitungdata('SELECT nip, COUNT(nip) AS jumlahdata FROM '.$p);
	if($cex < 1){
		$nip = 'NIP10001';
	}
	else{
		$cex = mysql_fetch_array(mysql_query('SELECT nip FROM '.$p.' ORDER BY urutan DESC LIMIT 0, 1'));
		$nip	= str_replace('NIP', '', $cex['nip']);
		$nip	= $nip+1;
		$nip	= 'NIP'.$nip;
	}
	
	
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
		else{
			// Create DateTime objects
			$birthDate = new DateTime($tgllhrpeg);
			$today = new DateTime();

			// Calculate the age difference
			$age = $today->diff($birthDate)->y;  // 'y' returns the difference in years

			// Check if the age is more than 20 and less than 50
			if ($age < 20) {
				$err['tgllhrpeg']	= 'Min. 20 thn!';
			} elseif ($age > 50) {
				$err['tgllhrpeg']	= 'Max. 50 thn!';
			}

		}

		
		// -- Validasi Jenis Kelamin Pegawai -- //
		if(!$jnskelpeg){
			$err['jnskelpeg']	= 'Harap Masukkan Jenis Kelamin Pegawai';	
		}

		if(!$err){
			$cek = mysql_query('SELECT nip FROM '.$p.' WHERE nip="'.dbres($nip).'"');
			if(mysql_num_rows($cek)>0){
				echo '<h6 class="page-header wow bounceIn" data-wow-delay=".7s"><font color="red">NIP Sudah Ada!</font></h6><br />';
			}
			else {
				$x = mysql_query('INSERT INTO '.$p.' VALUES("'.dbres($nip).'", "'.dbres($namapeg).'", "'.dbres($almpeg).'", "'.dbres($telppeg).'", "'.dbres(FlipDate($tgllhrpeg, 'ymd')).'", "'.dbres($jnskelpeg).'", "")');
				
				if($x){
					set_my_messages_to_user('Data Berhasil Ditambahkan!');
					redirect('index.php?p='.$p.'&act=view');
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
		<tr><td>NIP </td> <td> : </td> <td><div class="input-field"><input id="input1" maxlength="10" type="text" name="nip" value="'.$nip.'" disabled/>
		<label for="input1">NIP</label></div></td></tr>
	';


	if($err['nip']){
		echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['nip'].'</font></div></td></tr>';
	}


	echo '
		<tr><td>Nama Pegawai </td> <td> : </td>
		<td><div class="input-field"><input id="input2" type="text" name="namapeg" maxlength="25" value="'.$namapeg.'" />
		<label for="input2">Nama Pegawai</label></div></td></tr>
	';

	if($err['namapeg']){
		echo '
			<tr><td colspan="4">
			<div class="wow shake" data-wow-delay="1s">
			<font color="red">'.$err['namapeg'].'</font>
			</div></td></tr>
		';
	}

	echo '
		<tr><td>Alamat Pegawai </td> <td> : </td> <td><div class="input-field">
		<input id="input3" type="text" name="almpeg" value="'.$almpeg.'" maxlength="50" /><label for="input3">Alamat Pegawai</label></div></td></tr>
	';


	if($err['almpeg']){
		echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['almpeg'].'</font></div></td><tr>';
	}

	echo '
		<tr><td>Telpon Pegawai</td> <td> : </td>
		<td><div class="input-field">
		<input type="text" id="input4" maxlength="15" name="telppeg" value="'.$telppeg.'" />
		<label for="input4">Telpon Pegawai</label></div></td></tr>
	';


	if($err['telppeg']){
		echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['telppeg'].'</font></div></td><tr>';
	}

	echo '
		<tr><td>Tanggal Lahir Pegawai</td> <td> : </td>
		<td><div class="input-field"><input type="text" id="tgl_lahir" name="tgllhrpeg" value="'.$tgllhrpeg.'" /></div></td></tr>
	';


	if($err['tgllhrpeg']){
		echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['tgllhrpeg'].'</font></div></td><tr>';
	}
	if($jnskelpeg == 'L'){
		$ac = 'checked';
	}
	else{
		$ac='';
	}
		
	if($jnskelpeg == 'P'){
		$ax = 'checked';
	}
	else{
		$ax='';
	}


	echo '
		<tr><td>Jenis Kelamin Pegawai</td> <td> : </td>
		<td><div class="input-field">
		<input name="jnskelpeg" value="L" type="radio" id="radio-gender-1" '.$ac.' required />
		<label for="radio-gender-1">Laki - Laki</label>
		<input name="jnskelpeg" value="P" type="radio" id="radio-gender-2" '.$ax.' />
		<label for="radio-gender-2">Perempuan</label></div></td></tr>
	';


	if($err['jnskelpeg']){
		echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['jnskelpeg'].'</font></div></td><tr>';
}

	echo '
		<tr><td colspan="3"><center><button class="btn btn-primary">
		<i class="fa fa-plus"> Tambah</i></button></form>
		<a href="index.php?p='.$p.'&act=view">
		<button class="btn btn-danger red">
		<i class="fa fa-times"> Batal</i>
		</button>
		</a></center></td></tr></table>
	';

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