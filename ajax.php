<?php
define('MY_APP',1);

require_once 'inc/cnfg.php';


// -- Poli_Dok -- //
if($_GET['action'] == 'get_poliklinik'){
	if(strlen($_GET['q']) > 0){
		$q = mysql_query('SELECT kodepoli, namapoli FROM poliklinik WHERE kodepoli LIKE "%'.dbres($_GET['q']).'%" OR namapoli LIKE "%'.dbres($_GET['q']).'%" ORDER BY namapoli ASC LIMIT 0,10');
		$dtcache = array();
		while($data = mysql_fetch_assoc($q)){
			$data['id'] = xsc($data['kodepoli']);
			$data['text'] = xsc($data['namapoli']);
			$data['title'] = xsc($data['kodepoli']).' - '.xsc($data['namapoli']);
			$dtcache[] = $data;
		}
		$output = json_encode($dtcache);
		echo $output;
		exit();
	}
}

if($_GET['action'] == 'get_single_poliklinik'){
	if(isset($_GET['id']) && $_GET['id']){
		$q = mysql_query('SELECT kodepoli, namapoli FROM poliklinik WHERE kodepoli = "'.dbres($_GET['id']).'"');
		$data = mysql_fetch_assoc($q);
		$data['id'] = xsc($data['kodepoli']);
		$data['text'] = xsc($data['kodepoli']).' - '.xsc($data['namapoli']);
		$data['title'] = xsc($data['kodepoli']).' - '.xsc($data['namapoli']);
		$output = json_encode($data);
		echo $output;
		exit();
	}
}



// -- Kd_Dokter_jpra -- //
if($_GET['action'] == 'get_dokter'){
	if(strlen($_GET['q']) > 0){
		$q = mysql_query('SELECT kodedokter, nmdokter FROM dokter WHERE kodedokter LIKE "%'.dbres($_GET['q']).'%" OR nmdokter LIKE "%'.dbres($_GET['q']).'%" ORDER BY nmdokter ASC LIMIT 0,10');
		$dtcache = array();
		while($data = mysql_fetch_assoc($q)){
			$data['id'] = xsc($data['kodedokter']);
			$data['text'] = xsc($data['nmdokter']);
			$data['title'] = xsc($data['kodedokter']).' - '.xsc($data['nmdokter']);
			$dtcache[] = $data;
		}
		$output = json_encode($dtcache);
		echo $output;
		exit();
	}
}

if($_GET['action'] == 'get_single_dokter'){
	if(isset($_GET['id']) && $_GET['id']){
		$q = mysql_query('SELECT kodedokter, nmdokter FROM dokter WHERE kodedokter = "'.dbres($_GET['id']).'"');
		$data = mysql_fetch_assoc($q);
		$data['id'] = xsc($data['kodedokter']);
		$data['text'] = xsc($data['kodedokter']).' - '.xsc($data['nmdokter']);
		$data['title'] = xsc($data['kodedokter']).' - '.xsc($data['nmdokter']);
		$output = json_encode($data);
		echo $output;
		exit();
	}
}



// -- NIP_Pegawai -- //
if($_GET['action'] == 'get_nip'){
	if(strlen($_GET['q']) > 0){
		$q = mysql_query('SELECT nip, namapeg FROM pegawai WHERE nip LIKE "%'.dbres($_GET['q']).'%" OR namapeg LIKE "%'.dbres($_GET['q']).'%" ORDER BY namapeg ASC LIMIT 0,10');
		$dtcache = array();
		while($data = mysql_fetch_assoc($q)){
			$data['id'] = xsc($data['nip']);
			$data['text'] = xsc($data['namapeg']);
			$data['title'] = xsc($data['nip']).' - '.xsc($data['namapeg']);
			$dtcache[] = $data;
		}
		$output = json_encode($dtcache);
		echo $output;
		exit();
	}
}

if($_GET['action'] == 'get_single_nip'){
	if(isset($_GET['id']) && $_GET['id']){
		$q = mysql_query('SELECT nip, namapeg FROM pegawai WHERE nip = "'.dbres($_GET['id']).'"');
		$data = mysql_fetch_assoc($q);
		$data['id'] = xsc($data['nip']);
		$data['text'] = xsc($data['nip']).' - '.xsc($data['namapeg']);
		$data['title'] = xsc($data['nip']).' - '.xsc($data['namapeg']);
		$output = json_encode($data);
		echo $output;
		exit();
	}
}



// -- NoPasien_pendaftaran -- //
if($_GET['action'] == 'get_nopasien'){
	if(strlen($_GET['q']) > 0){
		$q = mysql_query('SELECT Nopasien, Namapas FROM pasien WHERE Nopasien LIKE "%'.dbres($_GET['q']).'%" OR Namapas LIKE "%'.dbres($_GET['q']).'%" ORDER BY Namapas ASC LIMIT 0,10');
		$dtcache = array();
		while($data = mysql_fetch_assoc($q)){
			$data['id'] = xsc($data['Nopasien']);
			$data['text'] = xsc($data['Namapas']);
			$data['title'] = xsc($data['Nopasien']).' - '.xsc($data['Namapas']);
			$dtcache[] = $data;
		}
		$output = json_encode($dtcache);
		echo $output;
		exit();
	}
}

if($_GET['action'] == 'get_single_nopasien'){
	if(isset($_GET['id']) && $_GET['id']){
		$q = mysql_query('SELECT Nopasien, Namapas FROM pasien WHERE Nopasien = "'.dbres($_GET['id']).'"');
		$data = mysql_fetch_assoc($q);
		$data['id'] = xsc($data['Nopasien']);
		$data['text'] = xsc($data['Nopasien']).' - '.xsc($data['Namapas']);
		$data['title'] = xsc($data['Nopasien']).' - '.xsc($data['Namapas']);
		$output = json_encode($data);
		echo $output;
		exit();
	}
}


// -- Idjenisbiaya_pen -- //
if($_GET['action'] == 'get_idjenisbiaya'){
	if(strlen($_GET['q']) > 0){
		$q = mysql_query('SELECT idjenisbiaya, namabiaya FROM jenisbiaya WHERE idjenisbiaya LIKE "%'.dbres($_GET['q']).'%" OR namabiaya LIKE "%'.dbres($_GET['q']).'%" ORDER BY namabiaya ASC LIMIT 0,10');
		$dtcache = array();
		while($data = mysql_fetch_assoc($q)){
			$data['id'] = xsc($data['idjenisbiaya']);
			$data['text'] = xsc($data['namabiaya']);
			$data['title'] = xsc($data['idjenisbiaya']).' - '.xsc($data['namabiaya']);
			$dtcache[] = $data;
		}
		$output = json_encode($dtcache);
		echo $output;
		exit();
	}
}

if($_GET['action'] == 'get_single_idjenisbiaya'){
	if(isset($_GET['id']) && $_GET['id']){
		$q = mysql_query('SELECT idjenisbiaya, namabiaya FROM jenisbiaya WHERE idjenisbiaya = "'.dbres($_GET['id']).'"');
		$data = mysql_fetch_assoc($q);
		$data['id'] = xsc($data['namabiaya']);
		$data['text'] = xsc($data['idjenisbiaya']).' - '.xsc($data['namabiaya']);
		$data['title'] = xsc($data['idjenisbiaya']).' - '.xsc($data['namabiaya']);
		$output = json_encode($data);
		echo $output;
		exit();
	}
}


// -- Kodejadwal_pen -- //
if($_GET['action'] == 'get_kodejadwal'){
	if(strlen($_GET['q']) > 0){
		$q = mysql_query('SELECT kodejadwal, nmdokter FROM jadwalpraktek LEFT JOIN dokter ON (kodedokter_jpra = kodedokter) WHERE kodejadwal LIKE "%'.dbres($_GET['q']).'%" OR nmdokter LIKE "%'.dbres($_GET['q']).'%" ORDER BY nmdokter ASC LIMIT 0,10');
		$dtcache = array();
		while($data = mysql_fetch_assoc($q)){
			$data['id'] = xsc($data['kodejadwal']);
			$data['text'] = xsc($data['nmdokter']);
			$data['title'] = xsc($data['kodejadwal']).' - '.xsc($data['nmdokter']);
			$dtcache[] = $data;
		}
		$output = json_encode($dtcache);
		echo $output;
		exit();
	}
}

if($_GET['action'] == 'get_single_kodejadwal'){
	if(isset($_GET['id']) && $_GET['id']){
		$q = mysql_query('SELECT nmdokter, kodejadwal FROM jadwalpraktek LEFT JOIN dokter ON (kodedokter_jpra = kodedokter) WHERE kodejadwal = "'.dbres($_GET['id']).'"');
		$data = mysql_fetch_assoc($q);
		$data['id'] = xsc($data['nmdokter']);
		$data['text'] = xsc($data['kodejadwal']).' - '.xsc($data['n']);
		$data['title'] = xsc($data['kodejadwal']).' - '.xsc($data['nmdokter']);
		$output = json_encode($data);
		echo $output;
		exit();
	}
}

// -- Nopendaftaran -- //
if($_GET['action'] == 'get_nopendaftaran'){
	if(strlen($_GET['q']) > 0){
		$q = mysql_query('SELECT nopendaftaran, Namapas FROM pendaftaran LEFT JOIN pasien ON (NoPasien_pen = Nopasien) WHERE nopendaftaran LIKE "%'.dbres($_GET['q']).'%" OR Namapas LIKE "%'.dbres($_GET['q']).'%" ORDER BY Namapas ASC LIMIT 0,10');
		$dtcache = array();
		while($data = mysql_fetch_assoc($q)){
			$data['id'] = xsc($data['nopendaftaran']);
			$data['text'] = xsc($data['Namapas']);
			$data['title'] = xsc($data['nopendaftaran']).' - '.xsc($data['Namapas']);
			$dtcache[] = $data;
		}
		$output = json_encode($dtcache);
		echo $output;
		exit();
	}
}

if($_GET['action'] == 'get_single_nopendaftaran'){
	if(isset($_GET['id']) && $_GET['id']){
		$q = mysql_query('SELECT nopendaftaran, Namapas FROM pendaftaran LEFT JOIN pasien ON (NoPasien_pen = Nopasien) WHERE nopendaftaran = "'.dbres($_GET['id']).'"');
		$data = mysql_fetch_assoc($q);
		$data['id'] = xsc($data['Namapas']);
		$data['text'] = xsc($data['nopendaftaran']).' - '.xsc($data['n']);
		$data['title'] = xsc($data['nopendaftaran']).' - '.xsc($data['Namapas']);
		$output = json_encode($data);
		echo $output;
		exit();
	}
}


// -- No Pemeriksaan -- //
if($_GET['action'] == 'get_nopemeriksaan'){
	if(strlen($_GET['q']) > 0){
		$q = mysql_query('SELECT nopemeriksaan, Namapas FROM pemeriksaan LEFT JOIN pendaftaran ON (nopendaftaran_pem = nopendaftaran) LEFT JOIN pasien ON (NoPasien_pen = Nopasien) WHERE nopemeriksaan LIKE "%'.dbres($_GET['q']).'%" OR Namapas LIKE "%'.dbres($_GET['q']).'%" ORDER BY Namapas ASC LIMIT 0,10');
		$dtcache = array();
		while($data = mysql_fetch_assoc($q)){
			$data['id'] = xsc($data['nopemeriksaan']);
			$data['text'] = xsc($data['Namapas']);
			$data['title'] = xsc($data['nopemeriksaan']).' - '.xsc($data['Namapas']);
			$dtcache[] = $data;
		}
		$output = json_encode($dtcache);
		echo $output;
		exit();
	}
}

if($_GET['action'] == 'get_single_nopemeriksaan'){
	if(isset($_GET['id']) && $_GET['id']){
		$q = mysql_query('SELECT nopemeriksaan, Namapas FROM pemeriksaan LEFT JOIN pendaftaran ON (nopendaftaran_pem = nopendaftaran) LEFT JOIN pasien ON (NoPasien_pen = Nopasien) WHERE nopemeriksaan = "'.dbres($_GET['id']).'"');
		$data = mysql_fetch_assoc($q);
		$data['id'] = xsc($data['Namapas']);
		$data['text'] = xsc($data['nopemeriksaan']).' - '.xsc($data['n']);
		$data['title'] = xsc($data['nopemeriksaan']).' - '.xsc($data['Namapas']);
		$output = json_encode($data);
		echo $output;
		exit();
	}
}



// -- Kode Obat -- //
if($_GET['action'] == 'get_kodeobat'){
	if(strlen($_GET['q']) > 0){
		$q = mysql_query('SELECT kodeobat, nmobat FROM obat WHERE kodeobat LIKE "%'.dbres($_GET['q']).'%" OR nmobat LIKE "%'.dbres($_GET['q']).'%" ORDER BY nmobat ASC LIMIT 0,10');
		$dtcache = array();
		while($data = mysql_fetch_assoc($q)){
			$data['id'] = xsc($data['kodeobat']);
			$data['text'] = xsc($data['nmobat']);
			$data['title'] = xsc($data['kodeobat']).' - '.xsc($data['nmobat']);
			$dtcache[] = $data;
		}
		$output = json_encode($dtcache);
		echo $output;
		exit();
	}
}

if($_GET['action'] == 'get_single_kodeobat'){
	if(isset($_GET['id']) && $_GET['id']){
		$q = mysql_query('SELECT kodeobat, nmobat FROM obat WHERE kodeobat = "'.dbres($_GET['id']).'"');
		$data = mysql_fetch_assoc($q);
		$data['id'] = xsc($data['nmobat']);
		$data['text'] = xsc($data['kodeobat']).' - '.xsc($data['n']);
		$data['title'] = xsc($data['kodeobat']).' - '.xsc($data['nmobat']);
		$output = json_encode($data);
		echo $output;
		exit();
	}
}
?>