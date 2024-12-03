<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');


	$title	= 'Update Data';
	require_once $inc_dir.'head.php';
	$id		= cek($_GET['id']);
	$field	= 'nopendaftaran';
		if($id){

	$get	= mysql_fetch_array(mysql_query('SELECT * FROM '.$p.' WHERE '.$field.'="'.dbres($id).'"'));
		if($get){

	$tglpendaftaran	= xsc($_POST['tglpendaftaran']);
	$Nopasien		= xsc($_POST['Nopasien']);
	$nip			= xsc($_POST['nip']);
	$kodejadwal		= xsc($_POST['kodejadwal']);



		if($_POST['submit'] == 'ok'){

	
	
		// -- Validasi No. Pasien -- //
	
			if(!$Nopasien){
	$err['Nopasien']	= 'Harap Masukkan No. Pasien!';

	}

	
	
		// -- Validasi Kode Jadwal -- //
	
			if(!$kodejadwal){
	$err['kodejadwal']	= 'Harap Masukkan Kode Jadwal!';

	}

	

	
			if (!$err){
	$v		= mysql_fetch_array(mysql_query('SELECT nip_log FROM login WHERE Username="'.$user_ck.'"'));

	$x		=	mysql_query('UPDATE '.$p.' SET
				Nopasien_pen="'.dbres($Nopasien).'",
				nip_pen="'.dbres($v['nip_log']).'", kodejadwal_pen="'.dbres($kodejadwal).'" 
				WHERE nopendaftaran="'.dbres($id).'"');

		if($x){
	set_my_messages_to_user('Data Berhasil Diupdate!');
	redirect('index.php?p='.$p.'&act=view');
	exit;
	}
	else {
	$tgl_pen = FlipDate($get['tglpendaftaran'], 'dmy');
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Gagal Diupdate!</h2>';
	}
	}
	}
	echo '	<table class="table table-bordered"><form method="post">';
	echo '	<tr><td> Kode Pendaftaran </td> <td> : </td> <td> <div class="input-field"><input disabled id="input1" type="text" 
			name="nopendaftaran" value="'.$get['nopendaftaran'].'" />
			<label for="input1">Kode Pendaftaran</label></div></td></tr>';
	
		if(isset($err['nopendaftaran'])){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['nopendaftaran'].'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td>Tanggal Pendaftaran </td> <td> : </td> <td><div class="input-field"><input type="text" id="tgl_pen"
			name="tglpendaftaran" value="'.FlipDate($get['tglpendaftaran'], 'dmy').'" disabled/>
			<label for="tgl_pen">Tanggal Pendaftaran</label></div></td></tr>';

		if($err['tglpendaftaran']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['tglpendaftaran'].'</font></div></td></tr>';
}
		
	echo '	<tr><td> No. Urut </td> <td> : </td> <td> <div class="input-field"><input id="input3" type="text" name="nourut" value="'.$get['nourut'].'" disabled/>
			<label for="input3">No. Urut</label></div> </td></tr>';

	
	
	echo '	<tr><td>Kode Pasien </td> <td> : </td> <td><div class="input-field">
			<input id="Nopasien" type="text" name="Nopasien" value="'.$get['Nopasien_pen'].'" /></div></td></tr>';


		if($err['Nopasien']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['Nopasien'].'</font></div></td><tr>';
}


	echo '	<tr><td>Kode Jadwal </td> <td> : </td> <td><div class="input-field">
			<input id="kodejadwal" type="text" name="kodejadwal" value="'.$get['kodejadwal_pen'].'" /></div></td></tr>';


		if($err['kodejadwal']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['kodejadwal'].'</font></div></td><tr>';
}

	
	
	echo '	<tr>
			<td colspan="3">
			<center>
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
		$("#Nopasien").select2({
			allowClear: true,
			width: 350,
			minimumInputLength: 1,
			ajax: {
				url: "ajax.php?action=get_nopasien",
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
					$.ajax("ajax.php?action=get_single_nopasien&id="+id, {
						dataType: "json"
					}).done(function(data) { callback(data); });
				}
			},
			formatResult: dtFormatResult,
			formatSelection: dtFormatSelection,
			escapeMarkup: function (m) { return m; }
		});

		$("#kodejadwal").select2({
			allowClear: true,
			width: 350,
			minimumInputLength: 1,
			ajax: {
				url: "ajax.php?action=get_kodejadwal",
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
					$.ajax("ajax.php?action=get_single_kodejadwal&id="+id, {
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