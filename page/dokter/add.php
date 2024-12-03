<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');

	//-- Config --//


	$title	= 'Tambah Data '.$p;
	
	require_once $inc_dir.'head.php';
	
	
	$nmdokter	= xsc($_POST['nmdokter']);
	$almdokter	= xsc($_POST['almdokter']);
	$telpdokter	= xsc($_POST['telpdokter']);
	$poli		= xsc($_POST['poli']);
	
	
			$cex	= hitungdata('SELECT kodedokter, COUNT(kodedokter) AS jumlahdata FROM '.$p);
	if($cex < 1){
		$kodedokter = 'KD10001';
	}
	else{
	$cex = mysql_fetch_array(mysql_query('SELECT kodedokter FROM '.$p.' ORDER BY urutan DESC LIMIT 0, 1'));
	$kodedokter	= str_replace('KD', '', $cex['kodedokter']);
	$kodedokter	= $kodedokter+1;
	$kodedokter	= 'KD'.$kodedokter;
	}
	
	
	
	
	// -- Validasi --//
		if ($_POST['submit'] == 'ok') {

	
	// -- Validasi Nama Dokter --//
	
			if(!$nmdokter){
	$err['nmdokter']	= 'Harap Masukkan Nama Dokter!';

	}
	elseif (!preg_match("/^[a-zA-Z ]*$/",$nmdokter)) {
	$err['nmdokter']	= 'Hanya Boleh Diisi Oleh Huruf dan Spasi';

	}
	elseif (strlen(trim($nmdokter))<3) {
	$err['nmdokter']	= 'Nama Dokter Harus Diisi Min. 3 Digit';

	}
	elseif (strlen(trim($nmdokter))>30) {
	$err['nmdokter']	= 'Nama Dokter Harus Diisi Max. 30 Digit';

	}

	// --  Validasi Alamat Dokter -- //
			if(!$almdokter){
	$err['almdokter']	= 'Harap Masukkan Alamat Dokter!';
	
	}
	elseif (strlen(trim($almdokter))<5) {
	$err['almdokter']	= 'Alamat Dokter Harus Diisi Min. 5 Digit';

	}
	elseif (strlen(trim($almdokter))>50) {
	$err['almdokter']	= 'Alamat Dokter Harus Diisi Max. 50 Digit';

	}
	

	
	
	// -- Validasi Telpon Dokter -- //
	
			if(!$telpdokter){
	$err['telpdokter']	= 'Harap Masukkan No. Telpon Dokter!';
	
	}
	elseif(!is_numeric($telpdokter)){
	$err['telpdokter']	= 'Hanya Boleh Diisi Dengan Angka';
	}
	elseif (strlen(trim($telpdokter))>15) {
	$err['telpdokter']	= 'No. Telpon Harus Diisi Max. 15 Digit';
	
	}
	elseif (strlen(trim($telpdokter))<5) {
	$err['telpdokter']	= 'No. Telpon Harus Diisi Min. 5 Digit';
	
	}
	
	if(!$poli){
		$err['poli']	= 'Harap Masukkan Kode Poli!';
	}
	


	if(!$err){
		$cek = mysql_query('SELECT kodedokter FROM '.$p.' WHERE kodedokter="'.dbres($kodedokter).'"');
		if(mysql_num_rows($cek)>0){
	echo '<h6 class="page-header wow bounceIn" data-wow-delay=".7s"><font color="red">Kode Dokter Sudah Ada!</font></h6><br />';
		}
	else {		
			
		$x = mysql_query('INSERT INTO '.$p.' 
			VALUES("'.dbres($kodedokter).'", "'.dbres($nmdokter).'", 
			"'.dbres($almdokter).'", "'.dbres($telpdokter).'", "'.dbres($poli).'", "")');
	if($x){
	set_my_messages_to_user('Data Berhasil Ditambahkan!');
	redirect('index.php?p='.$p.'&act=view');
	exit;
	}
	else {
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Gagal Ditambahkan!</h2>';
	
	}
	}
	}
	}


	echo '
	<script type="text/javascript">
	$(document).ready(function(){

		function dtFormatResult(dt) {
			var markup = \'<table class="maxwidth">\';
			markup += \'<tr>\';
			markup += \'<td class="nwrp tl"><div class="smalltext">\'+ dt.id +\'</div><div class="smalltext">\'+ dt.text +\'</div></td>\';
			markup += \'</tr>\';
			markup += \'</table>\'
			return markup;
		}
		function dtFormatSelection(dt) {
			return dt.title;
		}
		$("#poli").select2({
			allowClear: true,
			width: 350,
			minimumInputLength: 1,
			ajax: {
				url: "ajax.php?action=get_poliklinik",
				dataType: "json",
				data: function (term, page) {
					return {
						q: term
					};
				},
				results: function (data) {
					return {results: data};
				}
			},
			initSelection: function(element, callback) {
				var id = $(element).val();
				if (id !== "") {
					$.ajax("ajax.php?action=get_single_poliklinik&id="+id, {
						dataType: "json"
					}).done(function(data) { callback(data); });
				}
			},
			formatResult: dtFormatResult,
			formatSelection: dtFormatSelection,
			escapeMarkup: function (m) { return m; }
		});
	});
</script>

	<table class="table table-bordered">
	<form method="post">
	<input type="hidden" name="submit" value="ok" />
	<tr><td>Kode Dokter </td> <td> : </td> <td><div class="input-field"><input id="input1" type="text" name="kodedokter" value="'.$kodedokter.'" disabled/>
	<label for="input1">Kode Dokter</label></div></td></tr>';


		if($err['kodedokter']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['kodedokter'].'</font></div></td></tr>';
}


	echo '	<tr><td>Nama Dokter </td> <td> : </td> <td><div class="input-field"><input id="input2" type="text" name="nmdokter" value="'.$nmdokter.'" />
			<label for="input2">Nama Dokter</label></div></td></tr>';

		if($err['nmdokter']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['nmdokter'].'</font></div></td></tr>';
}

	echo '	<tr><td>Alamat Dokter </td> <td> : </td> <td><div class="input-field">
			<input id="input3" type="text" name="almdokter" value="'.$almdokter.'" /><label for="input3">Alamat Dokter</label></div></td></tr>';


		if($err['almdokter']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['almdokter'].'</font></div></td><tr>';
}

	echo '	<tr><td>Telpon Dokter</td> <td> : </td> <td><div class="input-field"><input type="text" id="input4" name="telpdokter" value="'.$telpdokter.'" />
			<label for="input4">Telpon Dokter</label></div></td></tr>';


if($err['telpdokter']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['telpdokter'].'</font></div></td><tr>';
}


	echo '<tr><td>Kode Poli</td> <td> : </td> <td><div class="input-field"><input type="text" id="poli" name="poli" value="'.$poli.'" />
			</div></td></tr>';
			
if($err['poli']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['poli'].'</font></div></td><tr>';
}
	

	echo '	<tr><td colspan="3"><center><button class="btn btn-primary">
			<i class="fa fa-plus"> Tambah</i></button></form>
			<a href="index.php?p='.$p.'&act=view">
			<button class="btn btn-danger red">
			<i class="fa fa-times"> Batal</i></button></a></center></td></tr></table>';

?>