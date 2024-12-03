<?php
		while($get = mysql_fetch_array($s)) {
				$data .= '	<tr>
							<td class="wow fadeIn" data-wow-delay=".3s">
							<input type="checkbox" class="chck" id="chck'.$no.'" name="chck[]" value="'.$get['kodejadwal'].'" />
							<label for="chck'.$no.'"></label></td>
							<td class="wow bounceIn" data-wow-delay=".5s">'.$no.'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['kodejadwal'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['hari'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['jammulai'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['jamselesai'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s"><a href="?p='.$p.'&act=update&id='.$get['kodejadwal'].'"
							data-toggle="popover" data-container="body" data-placement="left" data-trigger="hover"
							data-content="Edit data dengan kode jadwal '.$get['kodejadwal'].'"
							class="btn-floating btn-large waves-effect waves-light blue"><i class="fa fa-pencil-square-o"></i></a>
							<a href="?p='.$p.'&act=delete&id='.$get['kodejadwal'].'"
							data-toggle="popover" data-container="body" data-placement="right" data-trigger="hover"
							data-content="Hapus data dengan kode jadwal '.$get['kodejadwal'].'"
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
				<th>Kode Jadwal</th>
				<th>Hari</th>
				<th>Jam Mulai</th>
				<th>Jam Selesai</th>
				<th>Aksi</th>
				</tr></thead><tbody>';



	$hx		= '	<table class="table table-bordered table-hover"><tr>
				<td class="wow bounceIn" data-wow-delay=".5s" colspan="7" align="center"><h2>'.$a.'</h2></td></tr></table>';
	$dx		= '<tr><td align="center" colspan="7" class="wow bounceIn" data-wow-delay=".5s"><h2>Data Tidak Ditemukan!<h2></td></tr>';
	$herr	= '<tr><td align="center" colspan="7" class="wow bounceIn" data-wow-delay=".5s"><h2>Halaman Tidak Ada!<h2></td></tr>';
	
	
	
	// -- Jika Data pada tabel ada -- //
		if($data){
	$head	= $cx.$hx.$t.$h;
	$tx		= '	</tbody></table><table><tr><td><p>Aksi untuk yang dipilih: 
				<button class="wow fadeInLeft btn-floating btn-large waves-effect waves-light red" 
				data-container="body" data-toggle="popover" data-placement="right" data-wow-delay=".7s"
				data-trigger="hover" data-content="Hapus data yang dipilih"><i class="fa fa-trash"></i></button>
				<input type="hidden" name="deletex" value="ok" /></p></td></tr></table></form>';
	}
	else{
		if($hal > $thal && $thal != 0){
	$head	= $t.$herr;
		} else{
	$head	= $t.$dx;
		}
	$tx		= '</table>';

	}

	
	$datav = $search.$head.$data.$tx;
?>