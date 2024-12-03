<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');


	$title	= 'Update Data';
	require_once $inc_dir.'head.php';
	$id		= cek($_GET['id']);
	$field	= 'nopemeriksaan';
		if($id){

	$get	= mysql_fetch_array(mysql_query('SELECT * FROM '.$p.' WHERE '.$field.'="'.dbres($id).'"'));
		if($get){

	$keluhan		= xsc($_POST['keluhan']);
	$diagnosa		= xsc($_POST['diagnosa']);
	$perawatan		= xsc($_POST['perawatan']);
	$tindakan		= xsc($_POST['tindakan']);
	$beratbadan		= xsc($_POST['beratbadan']);
	$tensidiastolik	= xsc($_POST['tensidiastolik']);
	$tensisistolik	= xsc($_POST['tensisistolik']);
	$nopendaftaran	= xsc($_POST['nopendaftaran']);


		if($_POST['submit'] == 'ok'){
	

	
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
	$err['beratbadan']	= 'Harap Masukkan Berat Badan!';
	
	}
	elseif (!is_numeric($beratbadan)){
	
	$err['beratbadan']	= 'Hanya Boleh Diisi Dengan Angka';
	}
	elseif (strlen(trim($beratbadan))>3){ 
	
	$err['beratbadan']	= 'Harus Diisi Max. 3 Karakter';
	}
	
	
	
	// -- Validasi Tensi Diastolik -- //
			if(!$tensidiastolik){
	$err['tensidiastolik']	= 'Harap Tensi Diastolik!';
				
	}
	elseif(strlen(trim($tensidiastolik))>11){
	$err['tensidiastolik']	= 'Harus Diisi Max. 11 Karakter';
	}


	// -- Validasi Tensi Sistolik -- //
			if(!$tensisistolik){
	$err['tensisistolik']	= 'Harap Tensi Diastolik!';
				
	}
	elseif(strlen(trim($tensisistolik))>11){
	$err['tensisistolik']	= 'Harus Diisi Max. 11 Karakter';
	}

	
			if (!$err){
				
	$x		=	mysql_query('UPDATE '.$p.' SET 
				keluhan="'.dbres($keluhan).'", diagnosa="'.dbres($diagnosa).'", perawatan="'.dbres($perawatan).'", tindakan="'.dbres($tindakan).'",
				beratbadan="'.dbres($beratbadan).'", tensidiastolik="'.dbres($tensidiastolik).'", tensisistolik="'.dbres($tensisistolik).'",
				nopendaftaran_pem="'.dbres($nopendaftaran).'"
				WHERE nopemeriksaan="'.dbres($id).'"');

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
	echo '	<tr><td> Kode Pemeriksaan </td> <td> : </td> <td> <div class="input-field">
			<input id="input1" type="text" name="nopemeriksaan" value="'.$get['nopemeriksaan'].'" disabled/>
			<label for="input1">Kode Pemeriksaan</label></div></td></tr>';
	
		if($err['nopemeriksaan']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['nopemeriksaan'].'</font></div></td></tr>';
	
	}
	
	
	echo '	<tr><td> Kode Pendaftaran </td> <td> : </td> <td> <div class="input-field"><input id="nopendaftaran" type="text" name="nopendaftaran" 
			value="'.$get['nopendaftaran_pem'].'" /></div> </td></tr>';

		if($err['nopendaftaran']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['nopendaftaran'].'</font></div></td></tr>';
	
	}	

	
	
	
	echo '	<tr><td> Keluhan </td> <td> : </td> <td> <div class="input-field">
			<textarea class="materialize-textarea" id="input2" name="keluhan" maxlength="225">'.$get['keluhan'].'</textarea>
			<label for="input2">Keluhan</label></div></td></tr>';
		if($err['keluhan']){
		echo '<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['keluhan'].'</font></div></td></tr>';
		
	}
		
	echo '	<tr><td> Diagnosa </td> <td> : </td> <td> <div class="input-field">
			<textarea class="materialize-textarea" id="input3" name="diagnosa" maxlength="225">'.$get['diagnosa'].'</textarea>
			<label for="input3">Diagnosa</label></div> </td></tr>';

		if($err['diagnosa']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['diagnosa'].'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Perawatan </td> <td> : </td> <td> <div class="input-field">
			<textarea class="materialize-textarea" id="input4" name="perawatan" 
			maxlength="225">'.$get['perawatan'].'</textarea>
			<label for="input4">Perawatan</label></div> </td></tr>';

		if($err['perawatan']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['perawatan'].'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Tindakan </td> <td> : </td> <td> <div class="input-field">
			<textarea class="materialize-textarea" id="input5" name="tindakan" 
			maxlength="225">'.$get['tindakan'].'</textarea>
			<label for="input5">Tindakan</label></div> </td></tr>';

		if($err['tindakan']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['tindakan'].'</font></div></td></tr>';
	
	}


	echo '	<tr><td> Berat Badan </td> <td> : </td> <td> <div class="input-field"><input id="input6" type="text" name="beratbadan" 
			value="'.$get['beratbadan'].'" />
			<label for="input6">Berat Badan</label></div> </td></tr>';

		if($err['beratbadan']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['beratbadan'].'</font></div></td></tr>';
	
	}
	
	
	
	echo '	<tr><td> Tensi Diastolik </td> <td> : </td> <td> <div class="input-field"><input id="input7" type="text" name="tensidiastolik" 
			value="'.$get['tensidiastolik'].'" />
			<label for="input7">Tensi Diastolik</label></div> </td></tr>';

		if($err['tensidiastolik']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['tensidiastolik'].'</font></div></td></tr>';
	
	}	
	
	
	echo '	<tr><td> Tensi Sistolik </td> <td> : </td> <td> <div class="input-field"><input id="input8" type="text" name="tensisistolik" 
			value="'.$get['tensisistolik'].'" />
			<label for="input8">Tensi Sistolik</label></div> </td></tr>';

		if($err['tensisistolik']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['tensisistolik'].'</font></div></td></tr>';
	
	}

	
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