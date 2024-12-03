<?php

	$delx	= $_POST['deletex'];
	$delxx	= $_POST['deletexx'];
	$field	= 'kodeobat';
	$title	= 'Hapus Data '.$p;
require_once $inc_dir.'head.php';


		
		
		if($delx){
			$jml	= count($_POST['chck']);		//menghitung berapa data yang dicentang
			if($jml > 0){							//jika ada data yang dicentang
					$a	= '	<h5 class="page-header wow bounceIn" data-wow-delay=".7s">
					Anda yakin ingin menghapus data dari tabel '.$p.' dengan kode obat masing - masing adalah:
					<form method="post">';
					
					$c	= '	? </h5><br /><input type="hidden" name="deletexx" value="yes" />
					<button class="btn-floating btn-large waves-effect waves-light blue" 
					data-container="body" data-toggle="popover" data-placement="left"
					data-trigger="hover" data-content="Ya"><i class="fa fa-check-circle"></i></button></form>
					<a href="index.php?p='.$p.'&act=view" class="btn-floating btn-large waves-effect waves-light red" 
					data-container="body" data-toggle="popover" data-placement="right"
					data-trigger="hover" data-content="Tidak"><i class="fa fa-times-circle"></i></a>';
					
				for($i=0;$i<$jml;$i++){			//melakukan perulangan for
					$xx	= $_POST['chck'][$i];	//mengambil id dari tiap-tiap data yang dicentang
					
					$cek = mysql_fetch_array(mysql_query('SELECT '.$field.' FROM '.$p.' WHERE '.$field.'="'.$xx.'"')); //cek data
					
					if($cek) {
					$b .= '<input type="hidden" name="chckx['.$i.']" value="'.$xx.'" /><font color="red">'.$xx.'</font> ';
			
					} else{
					$err = '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Salah satu / semua dari data yang di pilih tidak ada!</h2>';
						}
					
			
				}
				if($err){
					echo $err;
					echo '<meta http-equiv="Refresh" content="2; URL=index.php?p='.$p.'&act=view">';

				}
				else{
					echo $a.$b.$c;
				}
				

			
		}else{			//jika tidak ada yang dicentang
			echo '<meta http-equiv="Refresh" content="2; URL=index.php?p='.$p.'&act=view">';
			echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Pilih data yang ingin dihapus!</h2>';
				require_once $inc_dir.'foot.php';
			exit;
		}
		}
		
 

		if($delxx == 'yes'){
				$jml	= count($_POST['chckx']);		//menghitung berapa data yang dicentang
			if($jml > 0){								//jika ada data yang dicentang
				for($i=0;$i<$jml;$i++){					//melakukan perulangan for
					$del_id	= $_POST['chckx'][$i];		//mengambil id dari tiap-tiap data yang dicentang
					$sql	= 'DELETE FROM '.$p.' WHERE '.$field.'="'.$del_id.'"';		//query delete
					$result	= mysql_query($sql) or die(mysql_error());						//menjalankan query delete diatas
				}
			if($result){	//jika data berhasil dihapus
		echo '<meta http-equiv="Refresh" content="2; URL=index.php?p='.$p.'&act=view">';
		echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data berhasil dihapus!</h2>';
		require_once $inc_dir.'foot.php';
		exit;
			}else{			//jika gagal menghapus data
		echo '<meta http-equiv="Refresh" content="2; URL=index.php?p='.$p.'&act=view">';
		echo '<h2 class="page-header wow bounceIn" data-wow-delay=".7s">Data gagal dihapus!</h2>';
		require_once $inc_dir.'foot.php';
		exit;
			}
			}
		}

	?>