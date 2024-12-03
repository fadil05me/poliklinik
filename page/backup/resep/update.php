<?php

	$title	= 'Update Data';
	require_once $inc_dir.'head.php';
	$id		= cek($_GET['id']);
	$field	= 'noresep';
		if($id){

	$get	= mysql_fetch_array(mysql_query('SELECT * FROM '.$p.' WHERE '.$field.'="'.dbres($id).'"'));
		if($get){

	$noresep	= $_POST['noresep'];
	$dosis		= $_POST['dosis'];
	$jumlah		= $_POST['jumlah'];



		if($_POST['submit'] == 'ok'){
	
	// -- Validasi No. Resep -- //
	
			if(!$noresep){
	$err1	= 'Harap Masukkan No. Resep!';

	}
	elseif(!is_numeric($noresep)){
	$err1	= 'Hanya Boleh Diisi Dengan Angka!';

	}
	elseif (strlen(trim($noresep))< 5) {
	$err1	= 'No. Resep Harus Diisi 5 Karakter';

	}
	elseif (strlen(trim($noresep))> 5) {
	$err1	= 'No. Resep Harus Diisi 5 Karakter';
	
	}
	
	// -- Validasi Dosis --//
	
			if(!$dosis){
	$err2	= 'Harap Masukkan Dosis!';

	}

	elseif (strlen(trim($dosis))<3) {
	$err2	= 'Dosis Harus Diisi Min. 3 Digit';

	}
	elseif (strlen(trim($dosis))>10) {
	$err2	= 'Dosis Harus Diisi Max. 25 Digit';

	}

	// --  Validasi Jumlah -- //
			if(!$jumlah){
	$err3	= 'Harap Masukkan Jumlah!';
	
	}
	elseif (strlen(trim($jumlah))<3) {
	$err3	= 'Jumlah Harus Diisi Min. 3 Digit';

	}
	elseif (strlen(trim($jumlah))>3) {
	$err3	= 'Jumlah Harus Diisi Max. 3 Digit';

	}


	
			if (!$err1 && !$err2 && !$err3){
				
	$x		=	mysql_query('UPDATE '.$p.' SET noresep="'.dbres($noresep).'", 
				dosis="'.dbres($dosis).'", jumlah="'.dbres($jumlah).'", telpdokter="'.dbres($telpdokter).'" 
				WHERE noresep="'.dbres($id).'"');

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
	echo '	<tr><td> No. Resep </td> <td> : </td> <td> <div class="input-field"><input id="input1" type="text" name="noresep" value="'.$get['noresep'].'" />
			<label for="input1">No. Resep</label></div></td></tr>';
	
		if(isset($err1)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err1.'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Dosis </td> <td> : </td> <td> <div class="input-field"><input id="input2" type="text" name="dosis" value="'.$get['dosis'].'" />
			<label for="input2">Dosis</label></div></td></tr>';
		if(isset($err2)){
		echo '<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err2.'</font></div></td></tr>';
		
	}
		
	echo '	<tr><td> Jumlah </td> <td> : </td> <td> <div class="input-field"><input id="input3" type="text" name="jumlah" value="'.$get['jumlah'].'" />
			<label for="input3">Jumlah</label></div> </td></tr>';

		if(isset($err3)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err3.'</font></div></td></tr>';
	
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