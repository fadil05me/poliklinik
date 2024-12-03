<?php

	//-- Config --//


	$title	= 'Tambah Data';
	
	require_once $inc_dir.'head.php';

	$kodepoli	= $_POST['kodepoli'];
	$namapoli	= $_POST['namapoli'];
	$Typeuser	= $_POST['Typeuser'];


	// -- Jika Sukses -- //
		if (isset($_GET['ok'])) {
	echo '<meta http-equiv="Refresh" content="2; URL=index.php?p='.$p.'&act=view">';
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Berhasil Ditambahkan!</h2>';
	require_once $inc_dir.'foot.php';
	exit;
}

	// -- Validasi --//
		if ($_POST['submit'] == 'ok') {
	
	
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



	if(!$err1 && !$err2 && !$err3){
		$cek = mysql_query('SELECT kodepoli FROM '.$p.' WHERE kodepoli="'.dbres($kodepoli).'"');
		if(mysql_num_rows($cek)>0){
	echo '<h6 class="page-header wow bounceIn" data-wow-delay=".7s"><font color="red">kodepoli Sudah Ada!</font></h6>';
		}
	else {		
			
		$x = mysql_query('INSERT INTO '.$p.' 
			VALUES("'.dbres($kodepoli).'", "'.dbres($namapoli).'")');
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
	<tr><td>Kode Poli </td> <td> : </td> <td><div class="input-field"><input id="input1" type="text" name="kodepoli" value="'.$kodepoli.'" />
	<label for="input1">Kode Poli</label></div></td></tr>';


		if($err1){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err1.'</font></div></td></tr>';
}


	echo '	<tr><td>Nama Poli </td> <td> : </td> <td><div class="input-field"><input id="input2" type="text" name="namapoli" value="'.$namapoli.'" />
			<label for="input2">Nama Poli</label></div></td></tr>';

		if($err2){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err2.'</font></div></td></tr>';
}





	echo '	<tr><td colspan="3"><center><button class="wow bounceInDown btn-floating btn-large waves-effect waves-light blue"
			data-container="body" data-toggle="popover" type="submit" data-wow-delay=".5s" data-placement="left" data-trigger="hover" data-content="Tambah Data">
			<i class="fa fa-plus"></i></button></form>
			<a href="index.php?p='.$p.'&act=view">
			<button class="wow bounceInDown btn-floating btn-large waves-effect waves-light red"
			data-container="body" data-toggle="popover" data-wow-delay="1s" data-placement="right" data-trigger="hover" data-content="Batal">
			<i class="fa fa-times"></i></button></a></center></td></tr></table>';

?>