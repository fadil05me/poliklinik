<?php

	//-- Config --//


	$title	= 'Tambah Data';
	
	require_once $inc_dir.'head.php';

	$noresep	= $_POST['noresep'];
	$dosis		= $_POST['dosis'];
	$jumlah		= $_POST['jumlah'];


	// -- Jika Sukses -- //
		if (isset($_GET['ok'])) {
	echo '<meta http-equiv="Refresh" content="2; URL=index.php?p='.$p.'&act=view">';
	echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Berhasil Ditambahkan!</h2>';
	require_once $inc_dir.'foot.php';
	exit;
}

	// -- Validasi --//
		if ($_POST['submit'] == 'ok') {
	
	
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
	



	if(!$err1 && !$err2 && !$err3){
		$cek = mysql_query('SELECT noresep FROM '.$p.' WHERE noresep="'.dbres($noresep).'"');
		if(mysql_num_rows($cek)>0){
	echo '<h6 class="page-header wow bounceIn" data-wow-delay=".7s"><font color="red">No. Resep Sudah Ada!</font></h6><br />';
		}
	else {		
			
		$x = mysql_query('INSERT INTO '.$p.' 
			VALUES("'.dbres($noresep).'", "'.dbres($dosis).'", 
			"'.dbres($jumlah).'", "'.dbres($telpdokter).'")');
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
	<tr><td>No. Resep </td> <td> : </td> <td><div class="input-field"><input id="input1" type="text" name="noresep" value="'.$noresep.'" />
	<label for="input1">No. Resep</label></div></td></tr>';


		if($err1){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err1.'</font></div></td></tr>';
}


	echo '	<tr><td>Dosis </td> <td> : </td> <td><div class="input-field"><input id="input2" type="text" name="dosis" value="'.$dosis.'" />
			<label for="input2">Dosis</label></div></td></tr>';

		if($err2){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err2.'</font></div></td></tr>';
}

	echo '	<tr><td>Jumlah </td> <td> : </td> <td><div class="input-field">
			<input id="input3" type="text" name="jumlah" value="'.$jumlah.'" /><label for="input3">Jumlah</label></div></td></tr>';


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