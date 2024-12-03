<?php

	//-- Config --//


	$title	= 'Tambah Data';
	
	require_once $inc_dir.'head.php';

	$nopendaftaran	= $_POST['nopendaftaran'];
	$tglpendaftaran	= $_POST['tglpendaftaran'];
	$nourut			= $_POST['nourut'];


	// -- Jika Sukses -- //
		if (isset($_GET['ok'])) {
	echo '<meta http-equiv="Refresh" content="2; URL=index.php?p='.$p.'&act=view">';
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Berhasil Ditambahkan!</h2>';
	require_once $inc_dir.'foot.php';
	exit;
}

	// -- Validasi --//
		if ($_POST['submit'] == 'ok') {
	
	
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



	if(!$err1 && !$err2 && !$err3){
		$cek = mysql_query('SELECT nopendaftaran FROM '.$p.' WHERE nopendaftaran="'.dbres($nopendaftaran).'"');
		if(mysql_num_rows($cek)>0){
	echo '<h6 class="page-header wow bounceIn" data-wow-delay=".7s"><font color="red">nopendaftaran Sudah Ada!</font></h6>';
		}
	else {		
			
		$x = mysql_query('INSERT INTO '.$p.' 
			VALUES("'.dbres($nopendaftaran).'", "'.dbres(tglmysql($tglpendaftaran)).'", 
			"'.dbres($nourut).'")');
	if($x){
		header('location: ?p='.$p.'&act=add&ok');
	}
	else {
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Gagal Ditambahkan!</h2>';
	
	}
	}
	}
	}


	echo '
	<table class="table table-bordered">
	<form method="post">
	<input type="hidden" name="submit" value="ok" />
	<tr><td>No. Pendaftaran </td> <td> : </td> <td><div class="input-field"><input id="input1" type="text" name="nopendaftaran" value="'.$nopendaftaran.'" />
	<label for="input1">No. Pendaftaran</label></div></td></tr>';


		if($err1){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err1.'</font></div></td></tr>';
}


	echo '	<tr><td>Tanggal Pendaftaran </td> <td> : </td> <td><div class="input-field"><input type="text" id="input2"
			name="tglpendaftaran" class="pikaday" value="'.$tglpendaftaran.'" />
			<label for="input2">Tanggal Pendaftaran</label></div></td></tr>';

		if($err2){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err2.'</font></div></td></tr>';
}

	echo '	<tr><td>No. Urut </td> <td> : </td> <td><div class="input-field">
			<input id="input3" type="text" name="nourut" value="'.$nourut.'" /><label for="input3">No Urut</label></div></td></tr>';


		if($err3){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err3.'</font></div></td><tr>';
}




	echo '	<tr><td colspan="3"><center><button class="wow bounceInDown btn-floating btn-large waves-effect waves-light blue"
			data-container="body" data-toggle="popover" type="submit" data-wow-delay=".5s" data-placement="left" data-trigger="hover" data-content="Tambah Data">
			<i class="fa fa-plus"></i></button></form>
			<a href="index.php?p='.$p.'&act=view">
			<button class="wow bounceInDown btn-floating btn-large waves-effect waves-light red"
			data-container="body" data-toggle="popover" data-wow-delay="1s" data-placement="right" data-trigger="hover" data-content="Batal">
			<i class="fa fa-times"></i></button></a></center></td></tr></table>';

?>