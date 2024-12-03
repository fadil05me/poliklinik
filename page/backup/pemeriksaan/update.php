<?php

	$title	= 'Update Data';
	require_once $inc_dir.'head.php';
	$id		= cek($_GET['id']);
	$field	= 'nopemeriksaan';
		if($id){

	$get	= mysql_fetch_array(mysql_query('SELECT * FROM '.$p.' WHERE '.$field.'="'.dbres($id).'"'));
		if($get){

	$nopemeriksaan	= $_POST['nopemeriksaan'];
	$keluhan		= $_POST['keluhan'];
	$diagnosa		= $_POST['diagnosa'];
	$perawatan		= $_POST['perawatan'];
	$tindakan		= $_POST['tindakan'];
	$beratbadan		= $_POST['beratbadan'];
	$tensidiastolik	= $_POST['tensidiastolik'];
	$tensisistolik	= $_POST['tensisistolik'];


		if($_POST['submit'] == 'ok'){
	
	// -- Validasi No Pemeriksaan -- //
	
			if(!$nopemeriksaan){
	$err1	= 'Harap Masukkan No Pemeriksaan!';

	}
	elseif (strlen(trim($nopemeriksaan))< 3) {
	$err1	= 'No Pemeriksaan Harus Diisi Min. 3 Karakter';

	}
	elseif (strlen(trim($nopemeriksaan))> 10) {
	$err1	= 'No Pemeriksaan Harus Diisi Max. 10 Karakter';

	}
	
	// -- Validasi Keluhan --//
	
			if(!$keluhan){
	$err2	= 'Harap Masukkan Keluhan!';

	}
	elseif (strlen(trim($keluhan))<3) {
	$err2	= 'Keluhan Harus Diisi Min. 3 Karakter';

	}
	elseif (strlen(trim($keluhan))>225) {
	$err2	= 'Keluhan Harus Diisi Max. 225 Karakter';

	}

	// --  Validasi Diagnosa -- //
			if(!$diagnosa){
	$err3	= 'Harap Masukkan Diagnosa!';
	
	}
	elseif (strlen(trim($diagnosa))<3) {
	$err3	= 'Diagnosa Harus Diisi Min. 3 Karakter';

	}
	elseif (strlen(trim($diagnosa))>225) {
	$err3	= 'Diagnosa Harus Diisi Max. 225 Karakter';

	}
	

	
	
	// -- Validasi Perawatan -- //
	
			if(!$perawatan){
	$err4	= 'Harap Masukkan Perawatan!';
	
	}
	elseif (strlen(trim($perawatan))>225) {
	$err4	= 'Harus Diisi Max. 225 Karakter';
	
	}
	elseif (strlen(trim($perawatan))<3) {
	$err4	= 'Harus Diisi Min. 3 Karakter';
	
	}
	
	
	
	// -- Validasi Tindakan -- //
	
			if(!$tindakan){
	$err5	= 'Harap Masukkan Tindakan!';
	
	}
	
	elseif (strlen(trim($tindakan))<3){
	
	$err5	= 'Harus Diisi Min. 3 Karakter';
	}
	elseif (strlen(trim($tindakan))>225){ 
	
	$err5	= 'Harus Diisi Max. 225 Karakter';
	}	
	
	// -- Validasi Berat Badan -- //
	
			if(!$beratbadan){
	$err6	= 'Harap Masukkan Berat Badan!';
	
	}
	elseif (!is_numeric($beratbadan)){
	
	$err6	= 'Hanya Boleh Diisi Dengan Angka';
	}
	elseif (strlen(trim($beratbadan))>3){ 
	
	$err6	= 'Harus Diisi Max. 3 Karakter';
	}
	
	
	
	// -- Validasi Tensi Diastolik -- //
			if(!$tensidiastolik){
	$err7	= 'Harap Tensi Diastolik!';
				
	}
	elseif(strlen(trim($tensidiastolik))>11){
	$err7	= 'Harus Diisi Max. 11 Karakter';
	}


	// -- Validasi Tensi Sistolik -- //
			if(!$tensisistolik){
	$err8	= 'Harap Tensi Diastolik!';
				
	}
	elseif(strlen(trim($tensisistolik))>11){
	$err8	= 'Harus Diisi Max. 11 Karakter';
	}

	
			if (!$err1 && !$err2 && !$err3 && !$err4 && !$err5 && !$err6 && !$err7 && !$err8){
				
	$x		=	mysql_query('UPDATE '.$p.' SET nopemeriksaan="'.dbres($nopemeriksaan).'", 
				keluhan="'.dbres($keluhan).'", diagnosa="'.dbres($diagnosa).'", perawatan="'.dbres($perawatan).'", tindakan="'.dbres($tindakan).'"
				beratbadan="'.dbres($beratbadan).'", tensidiastolik="'.dbres($tensidiastolik).'", tensisistolik="'.dbres($tensisistolik).'"
				WHERE nopemeriksaan="'.dbres($id).'"');

		if($x){
			
	echo '<meta http-equiv="Refresh" content="2; URL=index.php?p='.$p.'&act=view">';
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Berhasil Diupdate!</h2>';
	require_once $inc_dir.'foot.php';
	exit;
	}
	else {
		
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Gagal Diupdate!</h2>';
	}
	}
	}
	echo '	<table class="table table-bordered"><form method="post">';
	echo '	<tr><td> No Pemeriksaan </td> <td> : </td> <td> <div class="input-field"><input id="input1" type="text" name="nopemeriksaan" value="'.$get['nopemeriksaan'].'" />
			<label for="input1">No Pemeriksaan</label></div></td></tr>';
	
		if(isset($err1)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err1.'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Keluhan </td> <td> : </td> <td> <div class="input-field"><input id="input2" type="text" name="keluhan" value="'.$get['keluhan'].'" />
			<label for="input2">Keluhan</label></div></td></tr>';
		if(isset($err2)){
		echo '<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err2.'</font></div></td></tr>';
		
	}
		
	echo '	<tr><td> Diagnosa </td> <td> : </td> <td> <div class="input-field"><input id="input3" type="text" name="diagnosa" value="'.$get['diagnosa'].'" />
			<label for="input3">Diagnosa</label></div> </td></tr>';

		if(isset($err3)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err3.'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Perawatan </td> <td> : </td> <td> <div class="input-field"><input id="input4" type="text" name="perawatan" 
			value="'.$get['perawatan'].'" />
			<label for="input4">Perawatan</label></div> </td></tr>';

		if(isset($err4)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err4.'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Tindakan </td> <td> : </td> <td> <div class="input-field"><input id="input5" type="text" name="tindakan" 
			value="'.$get['tindakan'].'" />
			<label for="input5">Tindakan</label></div> </td></tr>';

		if(isset($err5)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err5.'</font></div></td></tr>';
	
	}


	echo '	<tr><td> Berat Badan </td> <td> : </td> <td> <div class="input-field"><input id="input6" type="text" name="beratbadan" 
			value="'.$get['beratbadan'].'" />
			<label for="input6">Berat Badan</label></div> </td></tr>';

		if(isset($err6)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err6.'</font></div></td></tr>';
	
	}
	
	
	
	echo '	<tr><td> Tensi Diastolik </td> <td> : </td> <td> <div class="input-field"><input id="input7" type="text" name="tensidiastolik" 
			value="'.$get['tensidiastolik'].'" />
			<label for="input7">Tensi Diastolik</label></div> </td></tr>';

		if(isset($err7)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err7.'</font></div></td></tr>';
	
	}	
	
	
	echo '	<tr><td> Tensi Sistolik </td> <td> : </td> <td> <div class="input-field"><input id="input8" type="text" name="tensisistolik" 
			value="'.$get['tensisistolik'].'" />
			<label for="input8">Tensi Sistolik</label></div> </td></tr>';

		if(isset($err8)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err8.'</font></div></td></tr>';
	
	}

	

	
	echo '	<tr><td colspan="3"><center><input type="hidden" name="submit" value="ok" />
			<button class="wow bounceInDown btn-floating btn-large waves-effect waves-light blue" 
			data-container="body" data-toggle="popover" data-wow-delay=".5s" data-placement="left"
			data-trigger="hover" data-content="Update"><i class="fa fa-check-circle"></i></button></form>
			<a href="index.php?p='.$p.'&act=view" class="wow bounceInDown btn-floating btn-large waves-effect waves-light red" 
			data-container="body" data-toggle="popover" data-placement="right"
			data-trigger="hover" data-content="Batal" data-wow-delay="1s"><i class="fa fa-times-circle"></i></a>
			</center></td></tr></table>';
			
	}
	
	else {
	echo '<meta http-equiv="Refresh" content="2; URL=index.php?p='.$p.'&act=view">';
	echo '<h2 class="page-header">Data Tidak Ada!</h2>';
	
	}
	}
	else {
	header('location: index.php?p='.$p.'&act=view');
	
	}
?>