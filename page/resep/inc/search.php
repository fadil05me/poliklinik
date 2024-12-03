<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');


	$cari	= $_GET['search'];
	$tipe	= $_GET['tipe'];
	
		if (!$tipe){

	$tipe	= 'noresep';
	}

	$search	= '	<table class="table table-bordered"><tr><td align="center">
				<a class="btn btn-default waves-effect waves-light" href="?p='.$p.'&act=add">Tambah Data</a></td><td align="center">
				<div class="input-field"><form action="index.php" method="get">
				<i class="fa fa-search prefix"></i><input type="hidden" name="p" value="'.$p.'" />
				<input type="hidden" name="act" value="view" />
				<input id="icon_prefix" type="text" class="validate" name="search" value="'.$cari.'">
				<label for="icon_prefix">Pencarian</label><div class="input-field col s12">
					<select name="tipe">
						<option value="" disabled selected>Pilih Kategori Pencarian</option>
						<option value="noresep">No. Resep</option>
						<option value="dosis">Dosis</option>
						<option value="jumlah">Jumlah</option>
						<option value="Namapas">Nama Pasien</option>
						<option value="nmobat">Nama Obat</option>
					</select></div>
				<button class="btn btn-default waves-effect waves-light" 
				data-container="body" data-toggle="popover" data-placement="right"
				data-trigger="hover" data-content="Cari"><i class="fa fa-search"></i></button></div></td></form></tr></table>';
				
				
	
	// -- Phal = jumlah data per halaman  -- //
	$phal	= '3';
	$no		= '1';
	$pgng	= cek($_GET['hal']);

if($pgng)
{
	$pgg 	= $pgng -1;
	$start	= $phal * $pgg;
}
else
{
	$start 	= 0;
}




// -- Kondisi Jika User sedang menggunakan Pencarian -- //
if($cari){

	$num	= hitungdata('SELECT noresep, COUNT(noresep) AS jumlahdata FROM '.$p.' LEFT JOIN pemeriksaan ON (nopemeriksaan_res = nopemeriksaan) LEFT JOIN pendaftaran ON (nopendaftaran_pem = nopendaftaran) LEFT JOIN pasien ON (Nopasien_pen = Nopasien) LEFT JOIN obat ON (kodeobat_res = kodeobat) WHERE '.dbres($tipe).' LIKE "%'.dbres($cari).'%"');
	$s		= mysql_query('SELECT p.*, Namapas, nmobat FROM '.$p.' p LEFT JOIN pemeriksaan ON (nopemeriksaan_res = nopemeriksaan) LEFT JOIN pendaftaran ON (nopendaftaran_pem = nopendaftaran) LEFT JOIN pasien ON (Nopasien_pen = Nopasien) LEFT JOIN obat ON (kodeobat_res = kodeobat) WHERE '.dbres($tipe).' LIKE "%'.dbres($cari).'%" LIMIT '.$start.', '.$phal);
	$a		= 'Ditemukan '.$num.' Data';
	$turi	= '?p='.$p.'&act=view&search='.$cari.'&tipe='.$tipe;
	$go		= '	<input type="hidden" name="p" value="'.$p.'" />
				<input type="hidden" name="act" value="view" />
				<input type="hidden" name="search" value="'.$cari.'" />
				<input type="hidden" name="tipe" value="'.$tipe.'" />';
}

// -- Jika Tidak -- //
else{
	$num	= hitungdata('SELECT noresep, COUNT(noresep) AS jumlahdata FROM '.$p);
	$s		= mysql_query('SELECT p.*, Namapas, nmobat FROM '.$p.' p LEFT JOIN pemeriksaan ON (nopemeriksaan_res = nopemeriksaan) LEFT JOIN pendaftaran ON (nopendaftaran_pem = nopendaftaran) LEFT JOIN pasien ON (Nopasien_pen = Nopasien) LEFT JOIN obat ON (kodeobat_res = kodeobat) LIMIT '.dbres($start).', '.$phal);
	$a		= 'Total Data '.$p.': '.$num;
	$turi	= '?p='.$p.'&act=view';
	$go		= '	<input type="hidden" name="p" value="'.$p.'" />
				<input type="hidden" name="act" value="view" />';
}
?>