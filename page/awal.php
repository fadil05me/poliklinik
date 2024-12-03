<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');

$title = 'Halaman Awal';
require_once $inc_dir.'head.php';
require_once $p_dir.'v-awal.php';


echo	'<h1 class="page-header">Apa yang ingin anda lakukan?</h1>
		<table class="table table-bordered table-hover"><tr>';
		if($auth <=2){echo	'<th>Dokter</th><th>Jadwal Praktek</th>';}
		if($auth ==3){echo	'<th colspan="3">Jenis Biaya</th>';}
		if($auth ==1){echo	'<th>Jenis Biaya</th>';}
		if($auth == 1){echo	'<th>Login</th>';}
		echo '</tr><tr>';
		if($auth <=2){ 
		echo	'<td>
		<a href="?p=dokter&act=view">
		<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Manage Data Dokter</button>
		</a>
		</td>
		<td>
		<a href="?p=jadwalpraktek&act=view">
		<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Manage Data Jadwal Praktek</button>
		</a>
		</td>';}
		if($auth ==3){
		echo '<td colspan="3">
		<a href="?p=jenisbiaya&act=view">
		<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Manage Data Jenis Biaya</button>
		</a>
		</td>';}
		if($auth ==1){
		echo '<td>
		<a href="?p=jenisbiaya&act=view">
		<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Manage Data Jenis Biaya</button>
		</a>
		</td>';}
		if($auth ==1){
		echo '<td>
		<a href="?p=login&act=view">
		<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Manage Data Login</button>
		</a>
		</td>';}
		echo '</tr><tr>';
		if($auth !=2){
		echo '<th>Obat</th>
		<th>Pasien</th>';}
		if($auth ==2){echo '<th colspan="2">Pegawai</th>';}
		if($auth ==1){echo '<th>Pegawai</th>';}
		if($auth !=2){echo '<th>Pemeriksaan</th>';}
		echo '</tr><tr>';
		if($auth !=2){
		echo '<td>
		<a href="?p=obat&act=view">
		<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Manage Data Obat</button>
		</a>
		</td>
		<td>
		<a href="?p=pasien&act=view">
		<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Manage Data Pasien</button>
		</a>
		</td>';}
		if($auth ==2){
		echo '<td colspan="2">
		<a href="?p=pegawai&act=view">
		<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Manage Data Pegawai</button>
		</a>
		</td>';}
		if($auth ==1){
		echo '<td>
		<a href="?p=pegawai&act=view">
		<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Manage Data Pegawai</button>
		</a>
		</td>';}
		if($auth !=2){
		echo '<td>
		<a href="?p=pemeriksaan&act=view">
		<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Manage Data Pemeriksaan</button>
		</a>
		</td>
		</tr>
		</table>';}
	

		
echo '	<table class="table table-bordered table-hover">';
		if($auth !=2){echo '<th>Pendaftaran</th>';}
		if($auth <=2){echo '<th>Poliklinik</th>';}
		if($auth !=2){echo '<th>Resep</th>';}
		echo '<tr>';
		if($auth !=2){
		echo '<td>
		<a href="?p=pendaftaran&act=view">
		<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Manage Data Pendaftaran</button>
		</a>
		</td>';}
		if($auth <=2){
		echo '<td>
		<a href="?p=poliklinik&act=view">
		<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Manage Data Poliklinik</button>
		</a>
		</td>';}
		if($auth !=2){
		echo '<td>
		<a href="?p=resep&act=view">
		<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">Manage Data Resep</button>
		</a>
		</td>';}
		echo '</tr>
		</table>';

		if($data && $auth !=2){

		

echo '	<p class="wow bounceIn" data-wow-delay="1s">3 Pasien Terakhir</p><table class="display table table-bordered table-striped table-hover"><thead><tr>
		<th>No</th>
		<th>No. Pasien</th>
		<th>Nama Pasien</th>
		<th>Alamat Pasien</th>
		<th>Telpon Pasien</th>
		<th>Tgl. Lahir Pas.</th>
		<th>Jenis Kelamin Pas.</th>
		<th>Tgl. Registrasi</th>
		</tr></thead>
		<tbody>'.$data.'</tbody>
		</table>';
		}
		
		



	
?>