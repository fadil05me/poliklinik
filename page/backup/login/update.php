<?php

	$title	= 'Update Data';
	require_once $inc_dir.'head.php';
	$id		= cek($_GET['id']);
	$field	= 'Username';
		if($id){

	$get	= mysql_fetch_array(mysql_query('SELECT * FROM '.$p.' WHERE '.$field.'="'.dbres($id).'"'));
		if($get){

	$Username	= $_POST['Username'];
	$Password	= $_POST['Password'];
	$Typeuser	= $_POST['Typeuser'];



		if($_POST['submit'] == 'ok'){
	
	// -- Validasi Username -- //
	
			if(!$Username){
	$err1	= 'Harap Masukkan Username!';

	}
	elseif (!preg_match("/^[a-zA-Z ]*$/",$Username)) {
	$err1	= 'Hanya Boleh Diisi Oleh Huruf dan Spasi';

	}
	elseif (strlen(trim($Username))< 3) {
	$err1	= 'Username Harus Diisi Min. 3 Karakter';

	}
	elseif (strlen(trim($Username))> 15) {
	$err1	= 'Username Harus Diisi Max.15 Karakter';

	}
	
	// -- Validasi Password --//
	
			if(!$Password){
	$err2	= 'Harap Masukkan Password!';

	}
	elseif (strlen(trim($Password))<7) {
	$err2	= 'Password Harus Diisi Min. 7 Karakter';

	}
	elseif (strlen(trim($Password))>25) {
	$err2	= 'Password Harus Diisi Max. 25 Karakter';
	
	}

	// --  Validasi Typeuser -- //
			if(!$Typeuser){
	$err3	= 'Harap Masukkan Typeuser!';
	
	}
	elseif (strlen(trim($Typeuser))<3) {
	$err3	= 'Typeuser Harus Diisi Min. 3 Karakter';
	
	}
	elseif (strlen(trim($Typeuser))>10) {
	$err3	= 'Typeuser Harus Diisi Max. 10 Karakter';
	
	}


	
			if (!$err1 && !$err2 && !$err3){
				

				
	$x		=	mysql_query('UPDATE '.$p.' SET Username="'.dbres($Username).'", 
				Password="'.dbres(md5($Password)).'", Typeuser="'.dbres($Typeuser).'" 
				WHERE Username="'.dbres($id).'"');

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
	echo '	<tr><td> Username </td> <td> : </td> <td> <div class="input-field"><input id="input1" type="text" name="Username" value="'.$get['Username'].'" />
			<label for="input1">Username</label></div></td></tr>';
	
		if(isset($err1)){
	echo '	<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err1.'</font></div></td></tr>';
	
	}
	
	echo '	<tr><td> Password </td> <td> : </td> <td> <div class="input-field"><input id="input2" type="password" name="Password" value="'.$get['Password'].'" />
			<label for="input2">Password</label></div></td></tr>';
		if(isset($err2)){
		echo '<tr><td colspan="3"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err2.'</font></div></td></tr>';
		
	}
		
	echo '	<tr><td> Typeuser </td> <td> : </td> <td> <div class="input-field"><input id="input3" type="text" name="Typeuser" value="'.$get['Typeuser'].'" />
			<label for="input3">Typeuser</label></div> </td></tr>';

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