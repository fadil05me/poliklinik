<?php

//-- Config --//

$id		= $_GET['id'];

	$title	= 'Detail Data '.$p.' No. '.$id;
require_once $inc_dir.'head.php';








	
	$s		= mysql_query('SELECT * FROM '.$p.' WHERE nopendaftaran="'.$id.'"');

	$get = mysql_fetch_array($s); 
				$data	= '	<tr>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['nopendaftaran'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.FlipDate($get['tglpendaftaran'], 'dmy').'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['nourut'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['Nopasien_pen'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['nip_pen'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['kodejadwal_pen'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s"><a href="?p='.$p.'&act=update&id='.$get['nopendaftaran'].'"
							class="btn-floating btn-large waves-effect waves-light blue"><i class="fa fa-pencil-square-o"></i></a>
							<a href="?p='.$p.'&act=delete&id='.$get['nopendaftaran'].'"
							class="btn-floating btn-large waves-effect waves-light red"><i class="fa fa-trash-o"></i></a></td>
							</tr>';
							
							
							

			



	$h		= '	<h1 class="page-header">Detail Data Pendaftaran '.$get['nopendaftaran'].'</h1>
				<table class="display table table-bordered table-striped table-hover">
				<thead>
				<th>Kode Pendaftaran</th>
				<th>Tanggal Pendaftaran</th>
				<th>No. Urut</th>
				<th>Kode Pasien</th>
				<th>NIP</th>
				<th>Kode Jadwal</th>
				<th>Aksi</th>
				</tr></thead><tbody>';
	
	
	
	$tx		= '	</tbody></table>';

	
		if(!$get){
	set_my_messages_to_user('Data Tidak Ditemukan!');
	redirect('index.php?p='.$p.'&act=view');
	exit;
	}

	echo my_messages_to_user().$h.$data.$tx;

?>