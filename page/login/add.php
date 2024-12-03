<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');

	//-- Config --//


	$title	= 'Tambah Data '.$p;
	
	require_once $inc_dir.'head.php';

	$Username	= xsc($_POST['Username']);
	$Password	= xsc($_POST['Password']);
	$Typeuser	= xsc($_POST['Typeuser']);
	$nip		= xsc($_POST['nip']);


	// -- Validasi --//
		if ($_POST['submit'] == 'ok') {
	
	
	// -- Validasi Username -- //
	
			if(!$Username){
	$err['Username']	= 'Harap Masukkan Username!';

	}
	elseif (!preg_match("/^[a-zA-Z ]*$/",$Username)) {
	$err['Username']	= 'Hanya Boleh Diisi Oleh Huruf dan Spasi';

	}
	elseif (strlen(trim($Username))< 3) {
	$err['Username']	= 'Username Harus Diisi Min. 3 Karakter';

	}
	elseif (strlen(trim($Username))> 15) {
	$err['Username']	= 'Username Harus Diisi Max. 15 Karakter';

	}
	
	// -- Validasi Password --//
	
			if(!$Password){
	$err['Password']	= 'Harap Masukkan Password!';

	}
	elseif (strlen(trim($Password))<7) {
	$err['Password']	= 'Password Harus Diisi Min. 7 Karakter';

	}
	elseif (strlen(trim($Password))>25) {
	$err['Password']	= 'Password Harus Diisi Max. 25 Karakter';
	
	}

	// --  Validasi Typeuser -- //
			if(!$Typeuser){
	$err['Typeuser']	= 'Harap Masukkan Typeuser!';
	
	}

	// -- Validasi NIP -- //
	
			if(!$nip){
	$err['nip']	= 'Harap Masukkan NIP!';

	}




	if(!$err){
		$cek = mysql_query('SELECT Username FROM '.$p.' WHERE Username="'.dbres($Username).'"');
		if(mysql_num_rows($cek)>0){
	echo '<h6 class="page-header wow bounceIn" data-wow-delay=".7s"><font color="red">Username Sudah Ada!</font></h6>';
		}
	else {
		$cek = mysql_query('SELECT nip_log FROM '.$p.' WHERE nip_log="'.dbres($nip).'"');
		if(mysql_num_rows($cek)>0){
	echo '<h6 class="page-header wow bounceIn" data-wow-delay=".7s"><font color="red">NIP Sudah Digunakan!</font></h6>';
		}
		else{
		
		
		$x = mysql_query('INSERT INTO '.$p.' 
			VALUES("'.dbres($Username).'", "'.dbres(md5($Password)).'", 
			"'.dbres($Typeuser).'", "'.dbres($nip).'")');
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
		$("#nip").select2({
			allowClear: true,
			width: 350,
			minimumInputLength: 1,
			ajax: {
				url: "ajax.php?action=get_nip",
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
					$.ajax("ajax.php?action=get_single_nip&id="+id, {
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
	<tr><td>Username </td> <td> : </td> <td><div class="input-field"><input id="input1" type="text" name="Username" value="'.$Username.'" />
	<label for="input1">Username</label></div></td></tr>';


		if($err['Username']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['Username'].'</font></div></td></tr>';
}


	echo '	<tr><td>Password </td> <td> : </td> <td><div class="input-field"><input id="input2" type="password" name="Password" value="'.$Password.'" />
			<label for="input2">Password</label></div></td></tr>';

		if($err['Password']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['Password'].'</font></div></td></tr>';
}



		if($Typeuser == 'Admin'){
			$adm = 'checked';
		}
		else{
			$adm ='';
		}
		
		if($Typeuser == 'Manager'){
			$mngr = 'checked';
		}
		else{
			$mngr ='';
		}
		
		if($Typeuser == 'Operator'){
			$usr = 'checked';
		}
		else{
			$usr = '';
		}




	echo '	<tr><td>Typeuser </td> <td> : </td> <td><div class="input-field">
			<input name="Typeuser" value="Admin" type="radio" id="typeuser-1" '.$adm.' />
			<label for="typeuser-1">Admin</label>
			<input name="Typeuser" value="Manager" type="radio" id="typeuser-2" '.$mngr.' />
			<label for="typeuser-2">Manager</label>
			<input name="Typeuser" value="Operator" type="radio" id="typeuser-3" '.$usr.' />
			<label for="typeuser-3">Operator</label>
			</div></td></tr>';


		if($err['Typeuser']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['Typeuser'].'</font></div></td><tr>';
}


	echo '	<tr><td>NIP </td> <td> : </td> <td><div class="input-field"><input id="nip" type="text" name="nip" value="'.$nip.'" />
			</div></td></tr>';

		if($err['nip']){
	echo '<tr><td colspan="4"><div class="wow shake" data-wow-delay="1s"><font color="red">'.$err['nip'].'</font></div></td></tr>';
}




	echo '	<tr><td colspan="3"><center><button class="btn btn-primary">
			<i class="fa fa-plus"> Tambah</i></button></form>
			<a href="index.php?p='.$p.'&act=view">
			<button class="btn btn-danger red">
			<i class="fa fa-times"> Batal</i></button></a></center></td></tr></table>';

?>