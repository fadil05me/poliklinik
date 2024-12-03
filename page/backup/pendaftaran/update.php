<?php

	$title	= 'Update Data';
	require_once $inc_dir.'head.php';
	$id		= cek($_GET['id']);
	$field	= 'nopendaftaran';
		if($id){

	$get	= mysql_fetch_array(mysql_query('SELECT * FROM '.$p.' WHERE '.$field.'="'.dbres($id).'"'));
		if($get){

	$nopendaftaran	= $_POST['nopendaftaran'];
	$tglpendaftaran	= $_POST['tglpendaftaran'];
	$nourut			= $_POST['nourut'];



		if($_POST['submit'] == 'ok'){
	
	// -- Validasi nopendaftaran -- //
	
			if(!$nopendaftaran){
	$err1	= 'Harap Masukkan No. Pendaftaran!';

	}
	elseif (!is_numeric($nopendaftaran)) {
	$err1	= 'Hanya Boleh Diisi Oleh Angka';

	}
	elseif (strlen(trim($nopendaftaran))< 3) {
	$err1	= 'No. Pendaftaran Harus Diisi Min. 3 Karakter';

	}
	elseif (strlen(trim($nopendaftaran))> 11) {
	$err1	= 'No. Pendaftaran Harus Diisi Max. 11 Karakter';

	}
	
	// -- Validasi tglpendaftaran --//
	
			if(!$tglpendaftaran){
	$err2	= 'Harap Masukkan Tanggal Pendaftaran!';

	}


	// --  Validasi nourut -- //
			if(!$nourut){
	$err3	= 'Harap Masukkan nourut!';
	
	}
	elseif (strlen(trim($nourut))<2) {
	$err3	= 'nourut Harus Diisi Min. 2 Karakter';
	
	}
	elseif (strlen(trim($nourut))>11) {
	$err3	= 'nourut Harus Diisi Max. 11 Karakter';
	
	}	

	
			if (!$err1 && !$err2 && !$err3){
				

				
	$x		=	mysql_query('UPDATE '.$p.' SET nopendaftaran="'.dbres($nopendaftaran).'", 
				tglpendaftaran="'.dbres(tglmysql($tglpendaftaran)).'", nourut="'.dbres($nourut).'" 
				WHERE nopendaftaran="'.dbres($id).'"');

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
	echo '	<tr><td> nopendaftaran </td> <td> : </td> <td> <div class="input-field"><input id="input1" type="text" name="nopendaftaran" value="'.$get['nopendaftaran'].'" />
			<label for="input1">nopendaftaran</label></div></td></tr>';
	
		if(isset($err1)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err1.'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td>Tanggal Pendaftaran </td> <td> : </td> <td><div class="input-field"><input type="text" id="input2"
			name="tglpendaftaran" class="pikaday" value="'.$get['tglpendaftaran'].'" />
			<label for="input2">Tanggal Pendaftaran</label></div></td></tr>';

		if($err2){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err2.'</font></div></td></tr>';
}
		
	echo '	<tr><td> nourut </td> <td> : </td> <td> <div class="input-field"><input id="input3" type="text" name="nourut" value="'.$get['nourut'].'" />
			<label for="input3">nourut</label></div> </td></tr>';

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