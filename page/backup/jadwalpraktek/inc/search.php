<?php

	$cari	= $_GET['search'];
	$tipe	= $_GET['tipe'];
	
		if (!$tipe){

	$tipe	= 'kodejadwal';
	}

	$search	= '	<table class="table table-bordered"><tr><td align="center">
				<a class="wow bounceInDown btn-floating btn-large waves-effect waves-light blue" data-wow-delay="1s" href="?p='.$p.'&act=add" 
				data-toggle="popover" data-placement="top" title="" data-trigger="hover" data-container="body"
				data-content="Tambah Data"><i class="fa fa-plus"></i></a></td><td align="center">
				<div class="input-field"><form action="index.php" method="get">
				<i class="fa fa-search prefix"></i><input type="hidden" name="p" value="'.$p.'" />
				<input type="hidden" name="act" value="view" />
				<input id="icon_prefix" type="text" class="validate" name="search" value="'.$cari.'">
				<label for="icon_prefix">Pencarian</label><div class="input-field col s12">
					<select name="tipe">
						<option value="" disabled selected>Pilih Kategori Pencarian</option>
						<option value="kodejadwal">Kode Jadwal</option>
						<option value="hari">Hari</option>
						<option value="jammulai">Jam Mulai</option>
						<option value="jamselesai">Jam Selesai</option>
					</select></div>
				<button class="btn btn-default waves-effect waves-light" 
				data-container="body" data-toggle="popover" data-placement="right"
				data-trigger="hover" data-content="Cari"><i class="fa fa-search"></i></button></div></td></form></tr></table>';

?>