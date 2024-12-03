<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');

switch($p){

	
		case 'logout':
	
	if(file_exists($p_dir.$p.'.php')){
			require_once $p_dir.$p.'.php';
	}
	else{
		require_once $p_dir.'404.php';
	}
	
			break;
	
	
	
	
	
		case 'dokter':
	
	if(is_dir($p_dir.$p)){
		
		if($auth <= 2){
		$xc = hitungdata('SELECT kodepoli, COUNT(kodepoli) AS jumlahdata FROM poliklinik');
		if($xc < 1){
			$title = 'Error';
		require_once $inc_dir.'head.php';
		echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Harap isi data poliklinik terlebih dahulu!</h2>';
		echo '<meta http-equiv="Refresh" content="2; URL=index.php">';
		require_once $inc_dir.'foot.php';
		exit;
		}

		require_once $p_dir.'act.php';

		}
		else{
		
		require_once $p_dir.'403.php';
			
		}
	}
	else{
		require_once $p_dir.'404.php';
	}
	
			break;
			

	case 'jadwalpraktek':
			if(is_dir($p_dir.$p)){
		if($auth <= 2){
		$xc = hitungdata('SELECT kodedokter, COUNT(kodedokter) AS jumlahdata FROM dokter');
		if($xc < 1){
			$title = 'Error';
		require_once $inc_dir.'head.php';
		echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Harap isi data Dokter terlebih dahulu!</h2>';
		echo '<meta http-equiv="Refresh" content="2; URL=index.php">';
		require_once $inc_dir.'foot.php';
		exit;
		}

		require_once $p_dir.'act.php';

		}
		else{
		
		require_once $p_dir.'403.php';
			
		}
	}
	else{
		require_once $p_dir.'404.php';
	}
			break;
	
	
	case 'jenisbiaya':
	
	if(is_dir($p_dir.$p)){
		$xc = hitungdata('SELECT nopendaftaran, COUNT(nopendaftaran) AS jumlahdata FROM pendaftaran');
		$yc = hitungdata('SELECT nopemeriksaan, COUNT(nopemeriksaan) AS jumlahdata FROM pemeriksaan');
		if($xc < 1){
			$title = 'Error';
		require_once $inc_dir.'head.php';
		echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Harap isi data Pendaftaran terlebih dahulu!</h2>';
		echo '<meta http-equiv="Refresh" content="2; URL=index.php">';
		require_once $inc_dir.'foot.php';
		exit;
		}
		elseif($yc < 1){
			$title = 'Error';
		require_once $inc_dir.'head.php';
		echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Harap isi data Pemeriksaan terlebih dahulu!</h2>';
		echo '<meta http-equiv="Refresh" content="2; URL=index.php">';
		require_once $inc_dir.'foot.php';
		exit;
		}
		elseif($auth != 2){
		require_once $p_dir.'act.php';
		}
		else{
		
		require_once $p_dir.'403.php';
			
		}
	}
	else{
		require_once $p_dir.'404.php';
	}
	
			break;
			
			
			
	case 'login':
	
	
			$xc = hitungdata('SELECT nip, COUNT(nip) AS jumlahdata FROM pegawai');
		if($xc < 1){
			$title = 'Error';
		require_once $inc_dir.'head.php';
		echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Harap isi data Pegawai terlebih dahulu!</h2>';
		echo '<meta http-equiv="Refresh" content="2; URL=index.php">';
		require_once $inc_dir.'foot.php';
		exit;
		}
		if(is_dir($p_dir.$p)){

				if($auth <= 1){
		require_once $p_dir.'act.php';
		}
		else{
		
		require_once $p_dir.'403.php';
			
		}
	}
	else{
		require_once $p_dir.'404.php';
	}
			break;
			
			
			
			
	case 'obat':
			if(is_dir($p_dir.$p)){
				
		if($auth != 2){

		require_once $p_dir.'act.php';

		}
		else{
		
		require_once $p_dir.'403.php';
			
		}
	}
	else{
		require_once $p_dir.'404.php';
	}
			break;
			
			
			
			
			
	case 'pasien':
			if(is_dir($p_dir.$p)){
		if($auth != 2){

		require_once $p_dir.'act.php';

		}
		else{
		
		require_once $p_dir.'403.php';
			
		}
	}
	else{
		require_once $p_dir.'404.php';
	}
			break;
			
			
			
			
	case 'pegawai':
			if(is_dir($p_dir.$p)){

		if($auth <= 2){
		require_once $p_dir.'act.php';
		}
		else{
		
		require_once $p_dir.'403.php';
			
		}	
	}
	else{
		require_once $p_dir.'404.php';
	}
			break;
			
			
			
			
			
	case 'pemeriksaan':
			if(is_dir($p_dir.$p)){
		if($auth != 2){
			$xc = hitungdata('SELECT Nopasien, COUNT(Nopasien) AS jumlahdata FROM pasien');
			$xca = hitungdata('SELECT nopendaftaran, COUNT(nopendaftaran) AS jumlahdata FROM pendaftaran');
		if($xc < 1){
			$title = 'Error';
		require_once $inc_dir.'head.php';
		echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Harap isi data Pasien terlebih dahulu!</h2>';
		echo '<meta http-equiv="Refresh" content="2; URL=index.php">';
		require_once $inc_dir.'foot.php';
		exit;
		}
		elseif($xca < 1){
			$title = 'Error';
		require_once $inc_dir.'head.php';
		echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Harap isi data Pendaftaran terlebih dahulu!</h2>';
		echo '<meta http-equiv="Refresh" content="2; URL=index.php">';
		require_once $inc_dir.'foot.php';
		exit;
		}


		require_once $p_dir.'act.php';

		}
		else{
		
		require_once $p_dir.'403.php';
			
		}
	}
	else{
		require_once $p_dir.'404.php';
	}
			break;
			
			
			
			
	case 'pendaftaran':
			if(is_dir($p_dir.$p)){
		if($auth != 2){
$zc = hitungdata('SELECT Nopasien, COUNT(Nopasien) AS jumlahdata FROM pasien');
$yc = hitungdata('SELECT nip, COUNT(nip) AS jumlahdata FROM pegawai');
$wc = hitungdata('SELECT kodejadwal, COUNT(kodejadwal) AS jumlahdata FROM jadwalpraktek');

		if($zc < 1){
			$title = 'Error';
		require_once $inc_dir.'head.php';
		echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Harap isi data Pasien terlebih dahulu!</h2>';
		echo '<meta http-equiv="Refresh" content="2; URL=index.php">';
		require_once $inc_dir.'foot.php';
		exit;
		}
		elseif($yc < 1){
			$title = 'Error';
		require_once $inc_dir.'head.php';
		echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Harap isi data Pegawai terlebih dahulu!</h2>';
		echo '<meta http-equiv="Refresh" content="2; URL=index.php">';
		require_once $inc_dir.'foot.php';
		exit;
		}
		elseif($wc < 1){
			$title = 'Error';
		require_once $inc_dir.'head.php';
		echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Harap isi data Jadwal Praktek terlebih dahulu!</h2>';
		echo '<meta http-equiv="Refresh" content="2; URL=index.php">';
		require_once $inc_dir.'foot.php';
		exit;
		}
		require_once $p_dir.'act.php';

		}
		else{
		
		require_once $p_dir.'403.php';
			
		}
	}
	else{
		require_once $p_dir.'404.php';
	}
			break;
			
			
			
			
			
			
	case 'poliklinik':
			if(is_dir($p_dir.$p)){
		if($auth <= 2){

		require_once $p_dir.'act.php';

		}
		else{
		
		require_once $p_dir.'403.php';
			
		}
	}
	else{
		require_once $p_dir.'404.php';
	}
			break;
			
			
			
			
			
	case 'resep':
			if(is_dir($p_dir.$p)){
				if($auth != 2){
		
		$xc = hitungdata('SELECT kodeobat, COUNT(kodeobat) AS jumlahdata FROM obat');
		$xcb = hitungdata('SELECT nopemeriksaan, COUNT(nopemeriksaan) AS jumlahdata FROM pemeriksaan');
		
		if($xc < 1){
			$title = 'Error';
		require_once $inc_dir.'head.php';
		echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Harap isi data Obat terlebih dahulu!</h2>';
		echo '<meta http-equiv="Refresh" content="2; URL=index.php">';
		require_once $inc_dir.'foot.php';
		exit;
		}
		elseif($xcb < 1){
			$title = 'Error';
		require_once $inc_dir.'head.php';
		echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Harap isi data Pemeriksaan terlebih dahulu!</h2>';
		echo '<meta http-equiv="Refresh" content="2; URL=index.php">';
		require_once $inc_dir.'foot.php';
		exit;
		}
		require_once $p_dir.'act.php';
		}else{
			require_once $p_dir.'403.php';
		}
	}
	else{
		require_once $p_dir.'404.php';
	}
			break;
			
			
			
			
			
			
			
			
	default:
			require_once $p_dir.'404.php';
			break;
}

?>