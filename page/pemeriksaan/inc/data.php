<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');

		while($get = mysql_fetch_array($s)) {
				$data .= '	<tr>
							<td class="wow fadeIn" data-wow-delay=".3s">
							<input type="checkbox" class="chck" id="chck'.$no.'" name="chck[]" value="'.$get['nopemeriksaan'].'" />
							<label for="chck'.$no.'"></label></td>
							<td>'.$no.'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['nopemeriksaan'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['Namapas'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['keluhan'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['diagnosa'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['perawatan'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['tindakan'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s"><a href="?p='.$p.'&act=view-det&id='.$get['nopemeriksaan'].'"
							data-toggle="popover" data-container="body" data-placement="left" data-trigger="hover"
							class="btn-floating btn-large waves-effect waves-light green"><i class="fa fa-eye"></i></a>
							<a href="?p='.$p.'&act=delete&id='.$get['nopemeriksaan'].'"
							class="btn-floating btn-large waves-effect waves-light red"><i class="fa fa-trash-o"></i></a></td>
							</tr>';
	$no++;
			}


	$cx		= '<form method="post" action="index.php?p='.$p.'&act=deletex">';
	$t		= '<table class="display table table-bordered table-striped table-hover">';			



	$h		= '	<thead><tr>
				<th><input type="checkbox" id="selectall" />
				<label for="selectall" data-container="body" 
				data-toggle="popover" data-placement="top" 
				data-trigger="hover" data-content="Pilih semua">
				</label></th>
				<th>No</th>
				<th>No Pemeriksaan</th>
				<th>Nama Pasien</th>
				<th>Keluhan</th>
				<th>Diagnosa</th>
				<th>Perawatan</th>
				<th>Tindakan</th>
				<th>Aksi</th>
				</tr></thead><tbody>';



	$hx		= '	<table class="table table-bordered table-hover"><tr>
				<td colspan="12" align="center"><h2>'.$a.'</h2></td></tr></table>';
	$dx		= '<tr><td align="center" colspan="12"><h2>Data Tidak Ditemukan!<h2></td></tr>';
	$herr	= '<tr><td align="center" colspan="1"><h2>Halaman Tidak Ada!<h2></td></tr>';
	
	
	// -- Jika Data pada tabel ada -- //
		if($data){
	$head	= $cx.$hx.$t.$h;
	$tx		= '	</tbody></table><table><tr><td><p>Aksi untuk yang dipilih: 
				<button class="btn btn-danger waves-effect waves-light red"><i class="fa fa-trash"> Hapus</i></button>
				<input type="hidden" name="deletex" value="ok" /></p></td></tr></table></form>';
	}
	else{
	
	// -- Jika Halaman Lebih dari total halaman & total halaman tidak = 0 -- //
		if($hal > $thal && $thal != 0){
	$head	= $t.$herr;
		} else{
	$head	= $t.$dx;
		}
	$tx		= '</table>';

	}

	
	$datav = $search.$head.$data.$tx;
?>