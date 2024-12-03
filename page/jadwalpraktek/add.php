<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');


	//-- Config --//


	$title	= 'Tambah Data';
	
	require_once $inc_dir.'head.php';


	$hari		= xsc($_POST['hari']);
	$jammulai	= xsc($_POST['jammulai']);
	$jamselesai	= xsc($_POST['jamselesai']);
	$kodedokter	= xsc($_POST['kodedokter']);
	
	
	
	$cex	= hitungdata('SELECT kodejadwal, COUNT(kodejadwal) AS jumlahdata FROM '.$p);
	if($cex < 1){
		$kodejadwal = 'KJ10001';
	}
	else{
	$cex = mysql_fetch_array(mysql_query('SELECT kodejadwal FROM '.$p.' ORDER BY urutan DESC LIMIT 0, 1'));
	$kodejadwal	= str_replace('KJ', '', $cex['kodejadwal']);
	$kodejadwal	= $kodejadwal+1;
	$kodejadwal	= 'KJ'.$kodejadwal;
	}
	
	
	

	// -- Validasi --//
		if ($_POST['submit'] == 'ok') {
	
	

	
	// -- Validasi Hari --//
	
			if(!$hari){
	$err['hari']	= 'Harap Masukkan Hari!';

	}
	
	
		$cekhri	= 	mysql_query('SELECT jammulai, jamselesai FROM '.$p.' 
				WHERE kodedokter_jpra="'.$kodedokter.'" AND hari="'.$hari.'"');
	$cekhri	= mysql_num_rows($cekhri);
	if($cekhri > 0){
		$err['hari']	= 'Dokter pada hari yang sama sudah ada';
	}
	
	
	

	// --  Validasi Jam Mulai -- //
			if(!$jammulai){
	$err['jammulai']	= 'Harap Masukkan Jam Mulai!';
	
	}

	

	
	
	// -- Validasi Jam Selesai -- //
	
			if(!$jamselesai){
	$err['jamselesai']	= 'Harap Masukkan Jam Selesai!';
	
	}
	
	
		// -- Validasi Jam -- //
	
	$jama	= explode(':', $jammulai);
	$jamb	= explode(':', $jamselesai);
	
	if($jama[0] > $jamb[0]){
	
	$err['jamselesai']		= 'Jam Selesai Harus Lebih dari Jam Mulai';
	}
	
	
	
	
	// -- Validasi Kode Dokter -- //
	
			if(!$kodedokter){
	$err['kodedokter']	= 'Harap Masukkan Kode Dokter';
	
	}


	if(!$err){
		$cek = mysql_query('SELECT kodejadwal FROM '.$p.' WHERE kodejadwal="'.dbres($kodejadwal).'"');
		if(mysql_num_rows($cek)>0){
	echo '<h6 class="page-header wow bounceIn" data-wow-delay=".7s"><font color="red">Kode Jadwal Sudah Ada!</font></h6><br />';
		}
	else {		
			
		$x = mysql_query('INSERT INTO '.$p.' 
			VALUES("'.dbres($kodejadwal).'", "'.dbres($hari).'", 
			"'.dbres($jammulai).'", "'.dbres($jamselesai).'", "'.dbres($kodedokter).'", "")');
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
		$("#kodedokter").select2({
			allowClear: true,
			width: 350,
			minimumInputLength: 1,
			ajax: {
				url: "ajax.php?action=get_dokter",
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
					$.ajax("ajax.php?action=get_single_dokter&id="+id, {
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
	<tr><td>Kode Jadwal </td> <td> : </td> <td><div class="input-field"><input id="input1" type="text" name="kodejadwal" value="'.$kodejadwal.'" disabled/>
	<label for="input1">Kode Jadwal</label></div></td></tr>';
	
	
		echo '	<tr><td>Kode Dokter</td> <td> : </td> <td><div class="input-field">
			<input id="kodedokter" name="kodedokter" type="text" value="'.$kodedokter.'">
			</div></td></tr>';


if($err['kodedokter']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['kodedokter'].'</font></div></td><tr>';
}

	
	
	if($hari){
		$hri[$hari]	= 'checked';
	}
	else{
		$hri	= '';
	}
	echo '	<tr><td>Hari</td> <td> : </td> <td><div class="input-field">
			<input name="hari" value="senin" type="radio" id="hari-1" required '.$hri['senin'].' />
			<label for="hari-1">Senin</label>
			<input name="hari" value="selasa" type="radio" id="hari-2" '.$hri['selasa'].' />
			<label for="hari-2">Selasa</label>
			<input name="hari" value="rabu" type="radio" id="hari-3" '.$hri['rabu'].' />
			<label for="hari-3">Rabu</label>
			<input name="hari" value="kamis" type="radio" id="hari-4" '.$hri['kamis'].' />
			<label for="hari-4">Kamis</label>
			<input name="hari" value="jum\'at" type="radio" id="hari-5" '.$hri['jum\'at'].' />
			<label for="hari-5">Jum\'at</label>
			<input name="hari" value="sabtu" type="radio" id="hari-6" '.$hri['sabtu'].' />
			<label for="hari-6">Sabtu</label>
			<input name="hari" value="minggu" type="radio" id="hari-7" '.$hri['minggu'].' />
			<label for="hari-7">Minggu</label>
			</div></td></tr>';

		if($err['hari']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['hari'].'</font></div></td></tr>';
}

	echo '	<tr><td>Jam Mulai </td> <td> : </td> <td><div class="input-field">
			<input id="jammulai" class="clockpicker" type="text" data-donetext="OK" name="jammulai" value="'.$jammulai.'" />
			</div></td></tr>';


		if($err['jammulai']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['jammulai'].'</font></div></td><tr>';
}

	echo '	<tr><td>Jam Selesai</td> <td> : </td> <td><div class="input-field">
			<input id="jamselesai" name="jamselesai" class="clockpicker" type="text" data-donetext="OK" value="'.$jamselesai.'">
			</div></td></tr>';


if($err['jamselesai']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['jamselesai'].'</font></div></td><tr>';
}



	echo '	<tr><td colspan="3"><center><button class="btn btn-primary">
			<i class="fa fa-plus"> Tambah</i></button></form>
			<a href="index.php?p='.$p.'&act=view">
			<button class="btn btn-danger red">
			<i class="fa fa-times"> Batal</i></button></a></center></td></tr></table>';

?>

<script type="text/javascript">
$('.clockpicker').clockpicker();
</script>