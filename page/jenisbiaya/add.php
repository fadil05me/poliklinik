<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');

	//-- Config --//


	$title	= 'Tambah Data';
	
	require_once $inc_dir.'head.php';

	$namabiaya		= $_POST['namabiaya'];
	$tarif			= $_POST['tarif'];
	$nopendaftaran	= $_POST['nopendaftaran'];
	
	
		$cex	= hitungdata('SELECT idjenisbiaya, COUNT(idjenisbiaya) AS jumlahdata FROM '.$p);
	if($cex < 1){
		$idjenisbiaya = 'IJ10001';
	}
	else{
	$cex = mysql_fetch_array(mysql_query('SELECT idjenisbiaya FROM '.$p.' ORDER BY urutan DESC LIMIT 0, 1'));
	$idjenisbiaya	= str_replace('IJ', '', $cex['idjenisbiaya']);
	$idjenisbiaya	= $idjenisbiaya+1;
	$idjenisbiaya	= 'IJ'.$idjenisbiaya;
	}
	
	
	

	// -- Validasi --//
		if ($_POST['submit'] == 'ok') {
	
	// -- Validasi Nama Biaya --//
	
			if(!$namabiaya){
	$err['namabiaya']	= 'Harap Masukkan Nama Biaya!';

	}
	elseif (!preg_match("/^[a-zA-Z ]*$/",$namabiaya)) {
	$err['namabiaya']	= 'Hanya Boleh Diisi Oleh Huruf dan Spasi';

	}
	elseif (strlen(trim($namabiaya))<3) {
	$err['namabiaya']	= 'Nama Biaya Harus Diisi Min. 3 Digit';

	}
	elseif (strlen(trim($namabiaya))>25) {
	$err['namabiaya']	= 'Nama Biaya Harus Diisi Max. 25 Digit';

	}

	// --  Validasi Tarif -- //
			if(!$tarif){
	$err['tarif']	= 'Harap Masukkan Tarif!';
	
	}
	elseif (strlen(trim($tarif))<3) {
	$err['tarif']	= 'Tarif Harus Diisi Min. 3 Digit';

	}
	elseif (strlen(trim($tarif))>10) {
	$err['tarif']	= 'Tarif Harus Diisi Max. 10 Digit';

	}
	elseif (!is_numeric($tarif)) {
	$err['tarif']	= 'Hanya Boleh Diisi Oleh Angka';

	}
	
	
	
	// -- Validasi Kode Pendaftaran -- //
	if(!$nopendaftaran){
		$err['nopendaftaran']	= 'Harap Masukkan Kode Pendaftaran!';
	}
	
	
	
	if(!$err){
		$cek = mysql_query('SELECT idjenisbiaya FROM '.$p.' WHERE idjenisbiaya="'.dbres($idjenisbiaya).'"');
		if(mysql_num_rows($cek)>0){
	echo '<h6 class="page-header wow bounceIn" data-wow-delay=".7s"><font color="red">ID Jenis Biaya Sudah Ada!</font></h6><br />';
		}
	else {		
			
		$x = mysql_query('INSERT INTO '.$p.' 
			VALUES("'.dbres($idjenisbiaya).'", "'.dbres($namabiaya).'", 
			"'.dbres($tarif).'", "'.dbres($nopendaftaran).'", "")');
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
	<table class="table table-bordered">
	<form method="post">
	<input type="hidden" name="submit" value="ok" />
	<tr><td>ID Jenis Biaya </td> <td> : </td> <td><div class="input-field"><input id="input1" type="text" name="idjenisbiaya" value="'.$idjenisbiaya.'" disabled/>
	<label for="input1">ID Jenis Biaya</label></div></td></tr>';


		if($err['idjenisbiaya']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['idjenisbiaya'].'</font></div></td></tr>';
}


	

	echo '	<tr><td>Kode Pendaftaran </td> <td> : </td> <td><div class="input-field">
			<input id="nopendaftaran" type="text" name="nopendaftaran" value="'.$nopendaftaran.'" />
			</div></td></tr>';

		if($err['nopendaftaran']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['nopendaftaran'].'</font></div></td></tr>';
}



	echo '	<tr><td>Nama Biaya </td> <td> : </td> <td><div class="input-field"><input id="input2" type="text" name="namabiaya" value="'.$namabiaya.'" />
			<label for="input2">Nama Biaya</label></div></td></tr>';

		if($err['namabiaya']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['namabiaya'].'</font></div></td></tr>';
}

	echo '	<tr><td>Tarif </td> <td> : </td> <td><div class="input-field">
			<input id="input3" type="text" name="tarif" value="'.$tarif.'" /><label for="input3">Tarif</label></div></td></tr>';


		if($err['tarif']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['tarif'].'</font></div></td><tr>';
}




	echo '	<tr><td colspan="3"><center><button class="btn btn-primary">
			<i class="fa fa-plus"> Tambah</i></button></form>
			<a href="index.php?p='.$p.'&act=view">
			<button class="btn btn-danger red">
			<i class="fa fa-times"> Batal</i></button></a></center></td></tr></table>';

?>


	<script type="text/javascript">
	$(document).ready(function(){

		function dtFormatResult(dt) {
			var markup = '<table class="maxwidth">';
			markup += '<tr>';
			markup += '<td class="nwrp tl"><div class="smalltext">'+ dt.id +'</div><div class="smalltext">'+ dt.text +'</div></td>';
			markup += '</tr>';
			markup += '</table>'
			return markup;
		}
		function dtFormatSelection(dt) {
			return dt.title;
		}
		$("#nopendaftaran").select2({
			allowClear: true,
			width: 350,
			minimumInputLength: 1,
			ajax: {
				url: "ajax.php?action=get_nopendaftaran",
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
					$.ajax("ajax.php?action=get_single_nopendaftaran&id="+id, {
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