<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');


	//-- Config --//


	$title	= 'Tambah Data';
	
	require_once $inc_dir.'head.php';

	$keluhan		= xsc($_POST['keluhan']);
	$diagnosa		= xsc($_POST['diagnosa']);
	$perawatan		= xsc($_POST['perawatan']);
	$tindakan		= xsc($_POST['tindakan']);
	$beratbadan		= xsc($_POST['beratbadan']);
	$tensidiastolik	= xsc($_POST['tensidiastolik']);
	$tensisistolik	= xsc($_POST['tensisistolik']);
	$nopendaftaran	= xsc($_POST['nopendaftaran']);
	
	
						$cex	= hitungdata('SELECT nopemeriksaan, COUNT(nopemeriksaan) AS jumlahdata FROM '.$p);
	if($cex < 1){
		$nopemeriksaan = 'PM10001';
	}
	else{
	$cex = mysql_fetch_array(mysql_query('SELECT nopemeriksaan FROM '.$p.' ORDER BY urutan DESC LIMIT 0, 1'));
	$nopemeriksaan	= str_replace('PM', '', $cex['nopemeriksaan']);
	$nopemeriksaan	= $nopemeriksaan+1;
	$nopemeriksaan	= 'PM'.$nopemeriksaan;
	}
	


	// -- Validasi --//
		if ($_POST['submit'] == 'ok') {
	
	


	
	
		// -- Validasi nopendaftaran -- //
	
			if(!$nopendaftaran){
	$err['nopendaftaran']	= 'Harap Masukkan No. Pendaftaran!';

	}

	elseif (strlen(trim($nopendaftaran))< 3) {
	$err['nopendaftaran']	= 'No. Pendaftaran Harus Diisi Min. 3 Karakter';

	}
	elseif (strlen(trim($nopendaftaran))> 11) {
	$err['nopendaftaran']	= 'No. Pendaftaran Harus Diisi Max. 11 Karakter';

	}
	

	
	// -- Validasi Keluhan --//
	
			if(!$keluhan){
	$err['keluhan']	= 'Harap Masukkan Keluhan!';

	}
	elseif (strlen(trim($keluhan))<3) {
	$err['keluhan']	= 'Keluhan Harus Diisi Min. 3 Karakter';

	}


	// --  Validasi Diagnosa -- //
			if(!$diagnosa){
	$err['diagnosa']	= 'Harap Masukkan Diagnosa!';
	
	}
	elseif (strlen(trim($diagnosa))<3) {
	$err['diagnosa']	= 'Diagnosa Harus Diisi Min. 3 Karakter';

	}


	
	
	// -- Validasi Perawatan -- //
	
			if(!$perawatan){
	$err['perawatan']	= 'Harap Masukkan Perawatan!';
	
	}
	elseif (strlen(trim($perawatan))<3) {
	$err['perawatan']	= 'Harus Diisi Min. 3 Karakter';
	
	}
	
	
	
	// -- Validasi Tindakan -- //
	
			if(!$tindakan){
	$err['tindakan']	= 'Harap Masukkan Tindakan!';
	
	}
	
	elseif (strlen(trim($tindakan))<3){
	
	$err['tindakan']	= 'Harus Diisi Min. 3 Karakter';
	}
	
	
	// -- Validasi Berat Badan -- //
	
			if(!$beratbadan){
	$beratbadan	= '';
	
	}
	if (!is_numeric($beratbadan)){
	
	$err['beratbadan']	= 'Hanya Boleh Diisi Dengan Angka';
	}
	elseif (strlen(trim($beratbadan))>3){ 
	
	$err['beratbadan']	= 'Harus Diisi Max. 3 Karakter';
	}
	
	
	
	// -- Validasi Tensi Diastolik -- //
			if(!$tensidiastolik){
	$tensidiastolik	= '';
				
	}
	if(strlen(trim($tensidiastolik))>11){
	$err['tensidiastolik']	= 'Harus Diisi Max. 11 Karakter';
	}


	// -- Validasi Tensi Sistolik -- //
			if(!$tensisistolik){
	$err['tensisistolik']	= 'Harap Tensi Diastolik!';
				
	}
	elseif(strlen(trim($tensisistolik))>11){
	$err['tensisistolik']	= 'Harus Diisi Max. 11 Karakter';
	}
	


	if(!$err){
		$cek = mysql_query('SELECT nopemeriksaan FROM '.$p.' WHERE nopemeriksaan="'.dbres($nopemeriksaan).'"');
		if(mysql_num_rows($cek)>0){
	echo '<h6 class="page-header wow bounceIn" data-wow-delay=".7s"><font color="red">No Pemeriksaan Sudah Ada!</font></h6><br />';
		}
	else {		
			
		$x = mysql_query('INSERT INTO '.$p.' 
			VALUES("'.dbres($nopemeriksaan).'", "'.dbres($keluhan).'", 
			"'.dbres($diagnosa).'", "'.dbres($perawatan).'", "'.dbres($tindakan).'", "'.dbres($beratbadan).'", 
			"'.dbres($tensidiastolik).'", "'.dbres($tensisistolik).'", "'.dbres($nopendaftaran).'", "")');
			
	if($x){
	set_my_messages_to_user('Data Berhasil Ditambahkan!');
	redirect('index.php?p=resep&act=add&id='.$nopemeriksaan);
	exit;
	}
	else {
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Gagal Ditambahkan!</h2>';
	
	}
	}
	}
	}


	echo my_messages_to_user().'
	<table class="table table-bordered">
	<form method="post">
	<input type="hidden" name="submit" value="ok" />
	<tr><td>Kode Pemeriksaan </td> <td> : </td> <td><div class="input-field"><input id="input1" type="text" name="nopemeriksaan" value="'.$nopemeriksaan.'" disabled/>
	<label for="input1">Kode Pemeriksaan</label></div></td></tr>';
	
	
	echo '	<tr><td> Kode Pendaftaran </td> <td> : </td> <td> <div class="input-field"><input id="nopendaftaran" type="text" name="nopendaftaran" 
			value="'.$nopendaftaran.'" /></div> </td></tr>';

		if($err['nopendaftaran']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['nopendaftaran'].'</font></div></td></tr>';
	
	}	


	echo '	<tr><td>Keluhan </td> <td> : </td> <td><div class="input-field">
			<textarea class="materialize-textarea" id="input2" name="keluhan" maxlength="225">'.$keluhan.'</textarea>
			<label for="input2">Keluhan</label></div></td></tr>';

		if($err['keluhan']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['keluhan'].'</font></div></td></tr>';
}

	echo '	<tr><td>Diagnosa </td> <td> : </td> <td><div class="input-field">
			<textarea class="materialize-textarea" id="input3" name="diagnosa" maxlength="225">'.$diagnosa.'</textarea>
			<label for="input3">Diagnosa</label></div></td></tr>';


		if($err['diagnosa']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['diagnosa'].'</font></div></td><tr>';
}

	echo '	<tr><td>Perawatan</td> <td> : </td> <td><div class="input-field">
			<textarea class="materialize-textarea" id="input4" name="perawatan" maxlength="225">'.$perawatan.'</textarea>
			<label for="input4">Perawatan</label></div></td></tr>';


		if($err['perawatan']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['perawatan'].'</font></div></td><tr>';
}

	echo '	<tr><td> Tindakan </td> <td> : </td> <td> <div class="input-field">
			<textarea class="materialize-textarea" id="input5" name="tindakan" 
			maxlength="225">'.$tindakan.'</textarea>
			<label for="input5">Tindakan</label></div> </td></tr>';

		if($err['tindakan']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['tindakan'].'</font></div></td></tr>';
	
	}

	
	echo '	<tr><td> Berat Badan </td> <td> : </td> <td> <div class="input-field"><input id="input6" type="text" name="beratbadan" 
			value="'.$beratbadan.'" />
			<label for="input6">Berat Badan</label></div> </td></tr>';

		if($err['beratbadan']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['beratbadan'].'</font></div></td></tr>';
	
	}
	
	
	
	echo '	<tr><td> Tensi Diastolik </td> <td> : </td> <td> <div class="input-field"><input id="input7" type="text" name="tensidiastolik" 
			value="'.$tensidiastolik.'" />
			<label for="input7">Tensi Diastolik</label></div> </td></tr>';

		if($err['tensidiastolik']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['tensidiastolik'].'</font></div></td></tr>';
	
	}	
	
	
	echo '	<tr><td> Tensi Sistolik </td> <td> : </td> <td> <div class="input-field"><input id="input8" type="text" name="tensisistolik" 
			value="'.$tensisistolik.'" />
			<label for="input8">Tensi Sistolik</label></div> </td></tr>';

		if($err['tensisistolik']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['tensisistolik'].'</font></div></td></tr>';
	
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
