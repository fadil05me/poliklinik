<?php

	$title	= 'Update Data';
	require_once $inc_dir.'head.php';
	$id		= cek($_GET['id']);
	$field	= 'kodepoli';
		if($id){

	$get	= mysql_fetch_array(mysql_query('SELECT * FROM '.$p.' WHERE '.$field.'="'.dbres($id).'"'));
		if($get){

	$kodepoli	= $_POST['kodepoli'];
	$namapoli	= $_POST['namapoli'];



		if($_POST['submit'] == 'ok'){

	
	// -- Validasi Kode Poli --//
	
			if(!$kodepoli){
	$err1	= 'Harap Masukkan Kode Poli!';

	}
	elseif (!is_numeric($kodepoli)) {
	$err1	= 'Kode Poli Harus Diisi Min. 7 Karakter';

	}
	elseif (strlen(trim($kodepoli))>5) {
	$err1	= 'Kode Poli Harus Diisi Max. 5 Karakter';
	
	}



	
	// -- Validasi Nama Poli -- //
	
			if(!$namapoli){
	$err2	= 'Harap Masukkan Nama Poli!';

	}
	elseif (!preg_match("/^[a-zA-Z ]*$/",$namapoli)) {
	$err2	= 'Hanya Boleh Diisi Oleh Huruf dan Spasi';

	}
	elseif (strlen(trim($namapoli))< 3) {
	$err2	= 'Nama Poli Harus Diisi Min. 3 Karakter';

	}
	elseif (strlen(trim($namapoli))> 50) {
	$err2	= 'Nama Poli Harus Diisi Max.50 Karakter';

	}
	
	

	
			if (!$err1 && !$err2 && !$err3){
				

				
	$x		=	mysql_query('UPDATE '.$p.' SET kodepoli="'.dbres($kodepoli).'", 
				namapoli="'.dbres($namapoli).'" WHERE kodepoli="'.dbres($id).'"');

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
	echo '	<tr><td> Kode Poli </td> <td> : </td> <td> <div class="input-field"><input id="input1" type="text" name="kodepoli" value="'.$get['kodepoli'].'" />
			<label for="input1">Kode Poli</label></div></td></tr>';
	
		if(isset($err1)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err1.'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Nama Poli </td> <td> : </td> <td> <div class="input-field"><input id="input2" type="text" name="namapoli" value="'.$get['namapoli'].'" />
			<label for="input2">Nama Poli</label></div></td></tr>';
		if(isset($err2)){
		echo '<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err2.'</font></div></td></tr>';
		
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