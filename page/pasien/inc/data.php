<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');

		while($get = mysql_fetch_array($s)) {
				$data .= '	<tr>
							<td class="wow fadeIn" data-wow-delay=".3s">
							<input type="checkbox" class="chck" id="chck'.$no.'" name="chck[]" value="'.$get['Nopasien'].'" />
							<label for="chck'.$no.'"></label></td>
							<td>'.$no.'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['Nopasien'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['Namapas'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['almpas'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['telppas'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.FlipDate($get['tgllahirpas'], 'dmy').' ('.umur($get['tgllahirpas']).' thn)</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['jeniskelpas'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.FlipDate($get['tglregistrasi'], 'dmy').'</td>
							<td class="wow fadeIn" data-wow-delay=".3s"><a href="?p='.$p.'&act=update&id='.$get['Nopasien'].'"
							class="btn-floating btn-large waves-effect waves-light blue"><i class="fa fa-pencil-square-o"></i></a>
							<a href="?p='.$p.'&act=delete&id='.$get['Nopasien'].'"
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
				<th>Kode Pasien</th>
				<th>Nama Pasien</th>
				<th>Alamat Pasien</th>
				<th>Telpon</th>
				<th>Tgl. Lahir</th>
				<th>Jenis Kelamin</th>
				<th>Tgl. Registrasi</th>
				<th>Aksi</th>
				</tr></thead><tbody>';



	$hx		= '	<table class="table table-bordered table-hover"><tr>
				<td colspan="10" align="center"><h2>'.$a.'</h2></td></tr></table>';
	$dx		= '	<tr><td align="center" colspan="10"><h2>Data Tidak Ditemukan!<h2></td></tr>';
	$herr	= '	<tr><td align="center" colspan="10"><h2>Halaman Tidak Ada!<h2></td></tr>';
	
	
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