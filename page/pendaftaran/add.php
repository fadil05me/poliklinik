<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');

	//-- Config --//

	$id		= $_GET['id'];
	$title	= 'Tambah Data';
	
	require_once $inc_dir.'head.php';

	$cex	= hitungdata('SELECT nourut, COUNT(nourut) AS jumlahdata FROM '.$p);
	if($cex < 1){
		$nourut = 'PS10001';
	}
	else{
	$cex = mysql_fetch_array(mysql_query('SELECT nourut FROM '.$p.' ORDER BY urutan DESC LIMIT 0, 1'));
	$nourut	= $cex['nourut']+1;
	}

	$Nopasien		= xsc($_POST['Nopasien']);
	$nip			= xsc($_POST['nip']);
	$kodejadwal		= xsc($_POST['kodejadwal']);
	
	if($id){
	$cex	= hitungdata('SELECT Nopasien, COUNT(Nopasien) AS jumlahdata FROM pasien WHERE Nopasien="'.$id.'"');
	if($cex < 1){
	set_my_messages_to_user('Kode Pasien Tidak Terdaftar!');
	redirect('index.php?p='.$p.'&act=add');
	exit;
	}
	else{
	$Nopasien		= $id;
	$nx				= 'disabled';
	}
	}



	
		$cex	= hitungdata('SELECT nopendaftaran, COUNT(nopendaftaran) AS jumlahdata FROM '.$p);
	if($cex < 1){
		$nopendaftaran = 'P10001';
	}
	else{
	$cex = mysql_fetch_array(mysql_query('SELECT nopendaftaran FROM '.$p.' ORDER BY urutan DESC LIMIT 0, 1'));
	$nopendaftaran	= str_replace('P', '', $cex['nopendaftaran']);
	$nopendaftaran	= $nopendaftaran+1;
	$nopendaftaran	= 'P'.$nopendaftaran;
	}
	
	
	

	// -- Validasi --//
		if ($_POST['submit'] == 'ok') {
	
	
	
		// -- Validasi No. Pasien -- //
	
			if(!$Nopasien){
	$err['Nopasien']	= 'Harap Masukkan No. Pasien!';

	}

	
	
		// -- Validasi Kode Jadwal -- //
	
			if(!$kodejadwal){
	$err['kodejadwal']	= 'Harap Masukkan Kode Jadwal!';

	}
	
	
	
	
	
	
	if(!$err){
		$cek = mysql_query('SELECT nopendaftaran FROM '.$p.' WHERE nopendaftaran="'.dbres($nopendaftaran).'"');
		if(mysql_num_rows($cek)>0){
	echo '<h6 class="page-header wow bounceIn" data-wow-delay=".7s"><font color="red">nopendaftaran Sudah Ada!</font></h6>';
		}
	else {		
			
		$v = mysql_fetch_array(mysql_query('SELECT nip_log FROM login WHERE Username="'.$user_ck.'"'));
		$x = mysql_query('INSERT INTO '.$p.' 
			VALUES("'.dbres($nopendaftaran).'", "'.dbres(FlipDate(date('d-m-Y'), 'ymd')).'", 
			"'.dbres($nourut).'", "'.dbres($Nopasien).'", "'.dbres($v['nip_log']).'", "'.dbres($kodejadwal).'", "")');
	if($x){
	set_my_messages_to_user('Data Berhasil Ditambahkan!');
	redirect('index.php?p='.$p.'&act=view-det&id='.$nopendaftaran);
	exit;
	}
	else {
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Gagal Ditambahkan!</h2>';
	echo 'INSERT INTO '.$p.' 
			VALUES("'.dbres($nopendaftaran).'", "'.dbres(FlipDate(date('d-m-Y'), 'ymd')).'", 
			"'.dbres($nourut).'", "'.dbres($Nopasien).'", "'.dbres($v['nip_log']).'", "'.dbres($kodejadwal).'", "")';
	}
	}
	}
	}
	
	


	echo my_messages_to_user().'
	<table class="table table-bordered">
	<form method="post">
	<input type="hidden" name="submit" value="ok" />
	<tr><td>Kode Pendaftaran </td> <td> : </td> <td><div class="input-field"><input id="input1" type="text" name="nopendaftaran" value="'.$nopendaftaran.'" disabled/>
	<label for="input1">Kode Pendaftaran</label></div></td></tr>';


		if($err['nopendaftaran']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['nopendaftaran'].'</font></div></td></tr>';
}


	echo '	<tr><td>Kode Pasien </td> <td> : </td> <td><div class="input-field">
			<input id="Nopasien" type="text" name="Nopasien" value="'.$Nopasien.'" '.$nx.'/></div></td></tr>';


		if($err['Nopasien']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['Nopasien'].'</font></div></td><tr>';
}


	echo '	<tr><td>Tanggal Pendaftaran </td> <td> : </td> <td><div class="input-field"><input type="text" id="tgl_pen"
			name="tglpendaftaran" value="'.date('d-m-Y').'" disabled/>
			<label for="tgl_pen">Tanggal Pendaftaran</label></div></td></tr>';

		if($err['tglpendaftaran']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['tglpendaftaran'].'</font></div></td></tr>';
}

	echo '	<tr><td>No. Urut </td> <td> : </td> <td><div class="input-field">
			<input id="input3" type="text" name="nourut" value="'.$nourut.'" disabled/>
			<label for="input3">No. Urut</label></div></td></tr>';






	echo '	<tr><td>Kode Jadwal </td> <td> : </td> <td><div class="input-field">
			<input id="kodejadwal" type="text" name="kodejadwal" value="'.$kodejadwal.'" /></div></td></tr>';


		if($err['kodejadwal']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['kodejadwal'].'</font></div></td><tr>';
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