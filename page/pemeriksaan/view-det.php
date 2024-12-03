<?php

//-- Config --//

$id		= $_GET['id'];

	$title	= 'Detail Data '.$p.' No. '.$id;
require_once $inc_dir.'head.php';










	$s		= 	mysql_query('SELECT p.*, nmobat, hargajual, merk
				FROM resep p 
				LEFT JOIN obat o ON (kodeobat = kodeobat_res)
				WHERE nopemeriksaan_res="'.$id.'"');

	while($get = mysql_fetch_array($s)){ 
		$tl = $get['jumlah'] * $get['hargajual'];
				$data1	.= '	<tr>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['nmobat'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['merk'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['dosis'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['jumlah'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">Rp. '.FormatHarga($get['hargajual']).'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">Rp. '.FormatHarga($tl).'</td>
							</tr>';

				$tot	+= $tl;
				

	}


	$s		= 	mysql_query('SELECT namabiaya, tarif
				FROM '.$p.' p 
				LEFT JOIN jenisbiaya j ON (nopendaftaran_jns = nopendaftaran_pem)
				WHERE nopemeriksaan="'.$id.'"');
				$row	= 1;
	while($get = mysql_fetch_array($s)){ 

		$xt = $get['tarif'];
				$data2	.= '	<tr>
								<td colspan="4" class="wow fadeIn" data-wow-delay=".3s">'.$get['namabiaya'].'</td>
								<td class="wow fadeIn" data-wow-delay=".3s">Rp. '.FormatHarga($get['tarif']).'</td>
								</tr>';

				$xtl	+= $xt;
				$row++;


	}
	
	
	
		if(!$get['namabiaya'] && !$get['tarif']){
		$data2 = '<tr>
								<td colspan="4" class="wow fadeIn" data-wow-delay=".3s">Tidak Ada</td>
								<td class="wow fadeIn" data-wow-delay=".3s">-</td>
								</tr>';
	}
	
	
	
	
	$s		= 	mysql_query('SELECT p.*,ps.Namapas  FROM '.$p.' p 
				LEFT JOIN pendaftaran pn ON (nopendaftaran_pem = nopendaftaran) 
				LEFT JOIN pasien ps ON (Nopasien_pen = Nopasien) WHERE nopemeriksaan="'.$id.'"');

	$get = mysql_fetch_array($s); 
				$data	= '	<tr>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['Namapas'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['nopemeriksaan'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['nopendaftaran_pem'].'</td>
							</tr>';

							$datax	= '	<tr>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['keluhan'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['diagnosa'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['perawatan'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['tindakan'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['beratbadan'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['tensidiastolik'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['tensisistolik'].'</td>
							</tr>';
							
							
							

			



	$h		= '	<br /><hr /><br /><table class="display table table-bordered table-striped table-hover">
				<thead>
				<tr>
				<th>Nama Pasien</th>
				<th>Kode Pemeriksaan</th>
				<th>Kode Pendaftaran</th>
				</tr></thead><tbody>';
	$ha		= '	<table class="display table table-bordered table-striped table-hover">
				<thead>
				<tr>
				<th>Keluhan</th>
				<th>Diagnosa</th>
				<th>Perawatan</th>
				<th>Tindakan</th>
				<th>Berat Badan</th>
				<th>Tensi Diastolik</th>
				<th>Tensi Sistolik</th>
				</tr></thead><tbody>';
	$h1		= '	<table class="display table table-bordered table-striped table-hover">
				<thead>
				<th>Nama Obat</th>
				<th>Merk</th>
				<th>Dosis</th>
				<th>Jumlah</th>
				<th>Biaya</th>
				<th>Total Biaya</th>
				</tr></thead><tbody>';
	$total	= $xtl+$tot;
	$xa		= '	<tr><td rowspan="'.$row.'" class="wow fadeIn" data-wow-delay=".3s">Biaya Lain</td></tr>
				'.$data2.'
				<tr><td colspan="5" class="wow fadeIn" data-wow-delay=".3s">Jumlah </td>
				<td class="wow fadeIn" data-wow-delay=".3s">Rp. '.FormatHarga($total).'</td></tr>
				';
	
	
	$tx		= '	</tbody></table>';

	
		if(!$get){
	set_my_messages_to_user('Data Tidak Ditemukan!');
	redirect('index.php?p='.$p.'&act=view');
	exit;
	}
	

	$a		= '	<tr><td colspan="7"><a href="?p='.$p.'&act=update&id='.$get['nopemeriksaan'].'"
				class="btn btn-primary waves-effect waves-light blue"><i class="fa fa-pencil-square-o"> Edit</i></a>
				<a href="?p='.$p.'&act=delete&id='.$get['nopemeriksaan'].'"
				class="btn btn-danger waves-effect waves-light red"><i class="fa fa-trash-o"> Hapus</i></a></td></tr>';
	
	echo my_messages_to_user().$h1.$data1.$xa.$tx.$h.$data.$tx.$ha.$datax.$a.$tx;

?>