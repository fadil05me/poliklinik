<?php

if(!defined('MY_APP')) die('No direct access allowed to this page.');

	$delx	= $_POST['deletex'];
	$delxx	= $_POST['deletexx'];
	$field	= 'Username';
	$title	= 'Hapus Data '.$p;
require_once $inc_dir.'head.php';


		
		
		if($delx){
			$jml	= count($_POST['chck']);		//menghitung berapa data yang dicentang
			if($jml > 0){							//jika ada data yang dicentang
					$a	= '	<h5 class="page-header">
					Anda yakin ingin menghapus data dari tabel '.$p.' dengan Username masing - masing adalah:
					<form method="post">';
					
					$c	= '	? </h5><br /><input type="hidden" name="deletexx" value="yes" />
					<button class="btn btn-primary"><i class="fa fa-check-circle"> Ya</i></button></form>
					<a href="index.php?p='.$p.'&act=view" class="btn btn-danger red"><i class="fa fa-times-circle"> Batal</i></a>';
					
				for($i=0;$i<$jml;$i++){			//melakukan perulangan for
					$xx	= $_POST['chck'][$i];	//mengambil id dari tiap-tiap data yang dicentang
					
					$cek = mysql_fetch_array(mysql_query('SELECT '.$field.' FROM '.$p.' WHERE '.$field.'="'.$xx.'"')); //cek data
					
					if($cek) {
					$b .= '<input type="hidden" name="chckx['.$i.']" value="'.$xx.'" /><font color="red">'.$xx.'</font> ';
			
					} else{
					$err = 'err';
						}
					
			
				}
				if($err == 'err'){
				set_my_messages_to_user('Salah satu / semua dari data yang di pilih tidak ada!');
				redirect('index.php?p='.$p.'&act=view');
				exit;
				}
				else{
					echo $a.$b.$c;
				}
				

			
		}else{			//jika tidak ada yang dicentang
			set_my_messages_to_user('Pilih data yang ingin dihapus!');
			redirect('index.php?p='.$p.'&act=view');
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
			
			set_my_messages_to_user('Data berhasil dihapus!');
			redirect('index.php?p='.$p.'&act=view');
			exit;
			}else{			//jika gagal menghapus data
			
			set_my_messages_to_user('Data gagal dihapus!');
			redirect('index.php?p='.$p.'&act=view');
			exit;
			}
			}
		}

	?>