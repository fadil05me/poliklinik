<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');

	$title	= 'Update Data';
	require_once $inc_dir.'head.php';
	$id		= cek($_GET['id']);
	$field	= 'noresep';
		if($id){

	$get	= mysql_fetch_array(mysql_query('SELECT * FROM '.$p.' WHERE '.$field.'="'.dbres($id).'"'));
		if($get){


	$dosis			= xsc($_POST['dosis']);
	$jumlah			= xsc($_POST['jumlah']);
	$nopemeriksaan	= xsc($_POST['nopemeriksaan']);
	$kodeobat		= xsc($_POST['kodeobat']);


		if($_POST['submit'] == 'ok'){
	
	// -- Validasi No Pemeriksaan -- //
	
			if(!$nopemeriksaan){
	$err['nopemeriksaan']	= 'Harap Masukkan Kode Pemeriksaan!';

	}
	elseif (strlen(trim($nopemeriksaan))< 5) {
	$err['nopemeriksaan']	= 'Kode Pemeriksaan Harus Diisi 5 Karakter';

	}
	elseif (strlen(trim($nopemeriksaan))> 10) {
	$err['nopemeriksaan']	= 'Kode Pemeriksaan Harus Diisi 10 Karakter';

	}
	
	
	// -- Validasi Kode Obat -- //
			if(!$kodeobat){
	$err['kodeobat']	= 'Harap Masukkan Kode Obat!';

	}
	elseif (strlen(trim($kodeobat))< 3) {
	$err['kodeobat']	= 'Kode Obat Harus Diisi Min. 3 Karakter';

	}
	elseif (strlen(trim($kodeobat))> 10) {
	$err['kodeobat']	= 'Kode Obat Harus Diisi Max. 10 Karakter';

	}
	
	
	
	// -- Validasi Dosis --//
	
			if(!$dosis){
	$err['dosis']	= 'Harap Masukkan Dosis!';

	}

	elseif (strlen(trim($dosis))<1) {
	$err['dosis']	= 'Dosis Harus Diisi Min. 1 Digit';

	}
	elseif (strlen(trim($dosis))>25) {
	$err['dosis']	= 'Dosis Harus Diisi Max. 25 Digit';

	}

	// --  Validasi Jumlah -- //
			if(!$jumlah){
	$err['jumlah']	= 'Harap Masukkan Jumlah!';
	
	}

	elseif (strlen(trim($jumlah))>3) {
	$err['jumlah']	= 'Jumlah Harus Diisi Max. 3 Digit';

	}


	
			if (!$err){
				
	$x		=	mysql_query('UPDATE '.$p.' SET
				dosis="'.dbres($dosis).'", jumlah="'.dbres($jumlah).'",
				nopemeriksaan_res="'.dbres($nopemeriksaan).'", kodeobat_res="'.dbres($kodeobat).'" 
				WHERE noresep="'.dbres($id).'"');

		if($x){
	set_my_messages_to_user('Data Berhasil Diupdate!');
	redirect('?p=pemeriksaan&act=view-det&id='.$nopemeriksaan);
	exit;
	}
	else {
		
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Gagal Diupdate!</h2>';
	}
	}
	}
	echo '	<table class="table table-bordered"><form method="post">';
	echo '	<tr><td> Kode Resep </td> <td> : </td> <td> <div class="input-field"><input id="input1" type="text" name="noresep" value="'.$get['noresep'].'" disabled/>
			<label for="input1">Kode Resep</label></div></td></tr>';
	
		if($err['noresep']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['noresep'].'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Dosis </td> <td> : </td> <td> <div class="input-field"><input id="input2" type="text" name="dosis" value="'.$get['dosis'].'" />
			<label for="input2">Dosis</label></div></td></tr>';
		if($err['dosis']){
		echo '<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['dosis'].'</font></div></td></tr>';
		
	}
		
	echo '	<tr><td> Jumlah </td> <td> : </td> <td> <div class="input-field"><input id="input3" type="text" name="jumlah" value="'.$get['jumlah'].'" />
			<label for="input3">Jumlah</label></div> </td></tr>';

		if($err['jumlah']){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['jumlah'].'</font></div></td></tr>';
	
	}
	
	
	echo '	<tr><td>Kode Pemeriksaan </td> <td> : </td> <td><div class="input-field">
			<input id="nopemeriksaan" type="text" name="nopemeriksaan" value="'.$get['nopemeriksaan_res'].'" /></div></td></tr>';


		if($err['nopemeriksaan']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['nopemeriksaan'].'</font></div></td><tr>';
}


	echo '	<tr><td>Kode Obat </td> <td> : </td> <td><div class="input-field">
			<input id="kodeobat" type="text" name="kodeobat" value="'.$get['kodeobat_res'].'" /></div></td></tr>';


		if($err['kodeobat']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['kodeobat'].'</font></div></td><tr>';
		}
	
	
	echo '	<tr><td colspan="3"><center><input type="hidden" name="submit" value="ok" />
			<button class="btn btn-primary"><i class="fa fa-check-circle"> Update</i></button></form>
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
		$("#nopemeriksaan").select2({
			allowClear: true,
			width: 350,
			minimumInputLength: 1,
			ajax: {
				url: "ajax.php?action=get_nopemeriksaan",
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
					$.ajax("ajax.php?action=get_single_nopemeriksaan&id="+id, {
						dataType: "json"
					}).done(function(data) { callback(data); });
				}
			},
			formatResult: dtFormatResult,
			formatSelection: dtFormatSelection,
			escapeMarkup: function (m) { return m; }
		});
		$("#kodeobat").select2({
			allowClear: true,
			width: 350,
			minimumInputLength: 1,
			ajax: {
				url: "ajax.php?action=get_kodeobat",
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
					$.ajax("ajax.php?action=get_single_kodeobat&id="+id, {
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