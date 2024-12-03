<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');


$nvbra	= '	<nav class="navbar light-blue">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
						<ul class="nav navbar-nav">
							<li'.$menusel['home'].'>
								<a class="waves-effect waves-light" href="index.php" 
								data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Beranda">
								<div style="color:white;font-weight:bold;"><i class="fa fa-home"></i></div></a>
							</li>';

		
// -- Jika User Tidak Login, -- //

		if(!$user_ck){
$nvbrb	= '<li></li>';

}

// -- Sebaliknya -- //
else{
if($auth == 2){
	$nvbrb	= '	<li'.$menusel['dokter'].'>
				<a href="index.php?p=dokter&act=view" 
				data-container="body" data-toggle="popover" data-placement="bottom" 
				data-trigger="hover" data-content="Data Dokter" class="waves-effect waves-light">
				<div style="color:white;font-weight:bold;">Dokter</div></a>
			</li>
			<li'.$menusel['pegawai'].'>
				<a href="index.php?p=pegawai&act=view" data-container="body" data-toggle="popover" data-placement="bottom" 
				data-trigger="hover" data-content="Data Pegawai" class="waves-effect waves-light">
				<div style="color:white;font-weight:bold;">Pegawai</div></a>
			</li>
			<li'.$menusel['jadwalpraktek'].'>
				<a href="index.php?p=jadwalpraktek&act=view" data-container="body" data-toggle="popover" data-placement="bottom" 
				data-trigger="hover" data-content="Data Jadwal Praktek" class="waves-effect waves-light">
				<div style="color:white;font-weight:bold;">Jadwal Praktek</div></a>
			</li>';
}
else{
$nvbrb	= '	<li'.$menusel['pasien'].'>
				<a href="index.php?p=pasien&act=view" 
				data-container="body" data-toggle="popover" data-placement="bottom" 
				data-trigger="hover" data-content="Data Pasein" class="waves-effect waves-light">
				<div style="color:white;font-weight:bold;">Pasien</div></a>
			</li>
			<li'.$menusel['pendaftaran'].'>
				<a href="index.php?p=pendaftaran&act=view" data-container="body" data-toggle="popover" data-placement="bottom" 
				data-trigger="hover" data-content="Data Pendaftaran" class="waves-effect waves-light">
				<div style="color:white;font-weight:bold;">Pendaftaran</div></a>
			</li>
			<li'.$menusel['pemeriksaan'].'>
				<a href="index.php?p=pemeriksaan&act=view" data-container="body" data-toggle="popover" data-placement="bottom" 
				data-trigger="hover" data-content="Data Pemeriksaan" class="waves-effect waves-light">
				<div style="color:white;font-weight:bold;">Pemeriksaan</div></a>
			</li>
			<li'.$menusel['resep'].'>
				<a href="index.php?p=resep&act=view" data-container="body" data-toggle="popover" data-placement="bottom" 
				data-trigger="hover" data-content="Data Resep" class="waves-effect waves-light">
				<div style="color:white;font-weight:bold;">Resep</div></a>
			</li>
			<li'.$menusel['obat'].'>
				<a href="index.php?p=obat&act=view" data-container="body" data-toggle="popover" data-placement="bottom" 
				data-trigger="hover" data-content="Data Obat" class="waves-effect waves-light">
				<div style="color:white;font-weight:bold;">Obat</div></a>
			</li>';
}
$nvbrd	= '	<ul class="nav navbar-nav right">
			<li>
				<a class="waves-effect waves-light"><div style="color:white;font-weight:bold;">Login Sebagai: '.$_SESSION['login_user'].'</div></a>
			</li>
			<li>
				<a href="index.php?p=logout" class="waves-effect waves-light"
				data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Keluar">
				<div style="color:white;font-weight:bold;"><i class="fa fa-sign-out"></i></div></a>
			</li>
			</ul>';
  
}
$nvbrc	= '	</ul>
				'.$nvbrd.'
				<ul class="nav navbar-nav right">
					<li>
						<a data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Muat Ulang"
						class="waves-effect waves-light" onclick="location.reload()"><div style="color:white;font-weight:bold;">
						<i class="fa fa-refresh"></i></div></a>
					</li>
				</ul>
			</div>
		</div></nav>';
			
echo $nvbra.$nvbrb.$nvbrc;
?>