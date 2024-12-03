<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');

	$field	= 'noresep';

	$title	= 'Hapus Data '.$p;
	require_once $inc_dir.'head.php';
	$g		= cek($_GET['id']);



	$s	= mysql_fetch_array(mysql_query('SELECT '.$field.' FROM '.$p.' where '.$field.'="'.dbres($g).'"'));
		if(!$s){
		set_my_messages_to_user('Data Tidak Ada!');
		redirect('index.php?p='.$p.'&act=view');
		exit;
		}


		if($_POST['yes'] == 'yes'){
	$x	= mysql_query('DELETE FROM '.$p.' where '.$field.'="'.dbres($g).'"');
	
		if ($x){
		set_my_messages_to_user('Data Berhasil Dihapus!');
		redirect('index.php?p='.$p.'&act=view');
		exit;
		}
		else{

		set_my_messages_to_user('Data Gagal Dihapus!');
		redirect('index.php?p='.$p.'&act=view');
		exit;
		}
		}

		if($_GET['id']){
		echo '	<h5 class="page-header">Apakah Anda yakin akan menghapus data dengan No. Resep '.$s[$field].' ?</h5>
				<table>
				<tr>
				<td>
				<form method="post">
				<input type="hidden" name="yes" value="yes" />
				<button class="btn btn-primary">
				<i class="fa fa-check-circle"> Ya</i></button></form>
				</td>
				<td>
				<a href="index.php?p='.$p.'&act=view"

				class="btn btn-danger red"><i class="fa fa-times-circle"> Batal</i></a>
				</td>
				</tr>
				</table>';
		}
		else {
		redirect('index.php?p='.$p.'&act=view');
		}

?>