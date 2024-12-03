<?php

	$field	= 'kodeobat';

	$title	= 'Hapus Data '.$p;
	require_once $inc_dir.'head.php';
	$g		= cek($_GET['id']);



	$s	= mysql_fetch_array(mysql_query('SELECT '.$field.' FROM '.$p.' where '.$field.'="'.dbres($g).'"'));
		if(!$s){
		echo '<meta http-equiv="Refresh" content="2; URL=index.php?p='.$p.'&act=view">';
		echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Tidak Ada!</h2>';
		require_once $inc_dir.'foot.php';
		exit;
		}


		if($_POST['yes'] == 'yes'){
	$x	= mysql_query('DELETE FROM '.$p.' where '.$field.'="'.dbres($g).'"');
	
		if ($x){
		echo '<meta http-equiv="Refresh" content="2; URL=index.php?p='.$p.'&act=view">';
		echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Berhasil Dihapus!</h2>';
		require_once $inc_dir.'foot.php';
		exit;
		}
		else{
		echo '<meta http-equiv="Refresh" content="2; URL=index.php?p='.$p.'&act=view">';
		echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data Gagal Dihapus!</h2>';
		require_once $inc_dir.'foot.php';
		exit;
		}
		}

		if($_GET['id']){
		echo '	<h5 class="page-header wow bounceIn" data-wow-delay=".7s">Apakah Anda yakin akan menghapus data dengan Kode Obat '.$s[$field].' ?</h5>
				<table>
				<tr>
				<td>
				<form method="post">
				<input type="hidden" name="yes" value="yes" />
				<button class="btn-floating btn-large waves-effect waves-light blue"
				data-container="body" data-toggle="popover" data-placement="left" data-trigger="hover" data-content="Ya">
				<i class="fa fa-check-circle"></i></button></form>
				</td>
				<td>
				<a href="index.php?p='.$p.'&act=view"
				data-container="body" data-toggle="popover" data-placement="right" data-trigger="hover" data-content="Batal"
				class="btn-floating btn-large waves-effect waves-light red"><i class="fa fa-times-circle"></i></a>
				</td>
				</tr>
				</table>';
		}
		else {
			header('location: index.php?p='.$p.'&act=view');
		}

?>