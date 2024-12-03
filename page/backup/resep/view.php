<?php

//-- Config --//



	$title	= 'Menampilkan Data Table '.$p;
require_once $inc_dir.'head.php';



// -- Definisikan Variabel -- //

	$cari	= $_GET['search'];
	$tipe	= $_GET['tipe'];
	
		if (!$tipe){

	$tipe	= 'noresep';
	}

	$search	= '	<table class="table table-bordered"><tr><td align="center">
				<a class="wow bounceInDown btn-floating btn-large waves-effect waves-light blue" data-wow-delay="1s" href="?p='.$p.'&act=add" 
				data-toggle="popover" data-placement="top" title="" data-trigger="hover" data-container="body"
				data-content="Tambah Data"><i class="fa fa-plus"></i></a></td><td align="center">
				<div class="input-field"><form action="index.php" method="get">
				<i class="fa fa-search prefix"></i><input type="hidden" name="p" value="'.$p.'" />
				<input type="hidden" name="act" value="view" />
				<input id="icon_prefix" type="text" class="validate" name="search" value="'.$cari.'">
				<label for="icon_prefix">Pencarian</label><div class="input-field col s12">
					<select name="tipe">
						<option value="" disabled selected>Pilih Kategori Pencarian</option>
						<option value="noresep">No. Resep</option>
						<option value="dosis">Dosis</option>
						<option value="jumlah">Jumlah</option>
					</select></div>
				<button class="btn btn-default waves-effect waves-light" 
				data-container="body" data-toggle="popover" data-placement="right"
				data-trigger="hover" data-content="Cari"><i class="fa fa-search"></i></button></div></td></form></tr></table>';


	$phal	= '7';
	$no		= '1';
	$pgng	= cek($_GET['hal']);

if($pgng)
{
	$pgg 	= $pgng -1;
	$start	= $phal * $pgg;
}
else
{
	$start 	= 0;
}


	$xhal 	= (isset($pgng)) ? (int)$pgng : 1;
	$hal 	= cek($xhal);


if($cari){

	$num	= hitungdata('SELECT noresep, COUNT(noresep) AS jumlahdata FROM '.$p.' WHERE '.dbres($tipe).' LIKE "%'.dbres($cari).'%"');
	$s		= mysql_query('SELECT * FROM '.$p.' WHERE '.dbres($tipe).' LIKE "%'.dbres($cari).'%" LIMIT '.$start.', '.$phal);

}

else{
	$num	= hitungdata('SELECT noresep, COUNT(noresep) AS jumlahdata FROM '.$p);
	$s		= mysql_query('SELECT * FROM '.$p.' LIMIT '.dbres($start).', '.$phal);

}

	$thal	= ceil($num/$phal);

	$hal	= (isset($_GET['hal'])) ? (int)$_GET['hal'] : 1;
	$start	= ($hal - 1) * $per_hal;

		while($get = mysql_fetch_array($s)) {
				$data .= '	<tr>
							<td class="wow fadeIn" data-wow-delay=".3s">
							<input type="checkbox" class="chck" id="chck'.$no.'" name="chck[]" value="'.$get['noresep'].'" />
							<label for="chck'.$no.'"></label></td>
							<td class="wow bounceIn" data-wow-delay=".5s">'.$no.'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['noresep'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['dosis'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['jumlah'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s"><a href="?p='.$p.'&act=update&id='.$get['noresep'].'"
							data-toggle="popover" data-container="body" data-placement="left" data-trigger="hover"
							data-content="Edit data dengan no resep '.$get['noresep'].'"
							class="btn-floating btn-large waves-effect waves-light blue"><i class="fa fa-pencil-square-o"></i></a>
							<a href="?p='.$p.'&act=delete&id='.$get['noresep'].'"
							data-toggle="popover" data-container="body" data-placement="right" data-trigger="hover"
							data-content="Hapus data dengan no resep '.$get['noresep'].'"
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
				<th>No. Resep</th>
				<th>Dosis</th>
				<th>Jumlah</th>
				<th>Aksi</th>
				</tr></thead><tbody>';


		if($cari){
	$a		= 'Ditemukan '.$num.' Data';
		}
	else{
	$a		= 'Total Data '.$p.': '.$num;
	}
	$hx		= '	<table class="table table-bordered table-hover"><tr>
				<td class="wow bounceIn" data-wow-delay=".5s" colspan="6" align="center"><h2>'.$a.'</h2></td></tr></table>';
	$dx		= '<tr><td align="center" colspan="6" class="wow bounceIn" data-wow-delay=".5s"><h2>Data Tidak Ditemukan!<h2></td></tr>';
	$herr	= '<tr><td align="center" colspan="6" class="wow bounceIn" data-wow-delay=".5s"><h2>Halaman Tidak Ada!<h2></td></tr>';
	

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

	echo $search.$head.$data.$tx;

	$back	= $hal -1;
	$next 	= $hal +1;

		if($cari){
	$turi	= '?p='.$p.'&act=view&search='.$cari.'&tipe='.$tipe;
	$go		= '	<input type="hidden" name="p" value="'.$p.'" />
				<input type="hidden" name="act" value="view" />
				<input type="hidden" name="search" value="'.$cari.'" />
				<input type="hidden" name="tipe" value="'.$tipe.'" />';
	}
	else{
	$turi	= '?p='.$p.'&act=view';
	$go		= '	<input type="hidden" name="p" value="'.$p.'" />
				<input type="hidden" name="act" value="view" />';
	}

	echo '<nav><ul class="pager">';

	$backx	= $turi.'&hal='.$back;
	$nextx	= $turi.'&hal='.$next;

		if($hal <= 1){
	$lclass	= ' disabled';
	$backx	= '#';
	}
	else{
	$backx	= $turi.'&hal='.$back;
	$lclass	= '';
	}
		if($hal == $thal){
	$rclass	= ' disabled';
	$nextx	= '#';
	}
	else{
	$rclass	= '';
	$nextx	= $turi.'&hal='.$next;
	}


		if($thal == 0 || $hal == 0 || $hal > $thal){
	$rclass	= ' disabled';
	$lclass	= ' disabled';
	$nextx	= '#';
	$backx	= '#';
	}


	echo '<li class="previous'.$lclass.'"><a href="'.$backx.'"><span aria-hidden="true">&larr;</span> Sebelumnya</a></li>';

	echo 'Halaman ke '.$hal.' dari Total Halaman: '.$thal;

	echo '<li class="next'.$rclass.'"><a href="'.$nextx.'"><span aria-hidden="true">&rarr;</span> Selanjutnya</a></li></ul></nav>';
	if($thal > 2){
	
	echo '<table><form action="'.$turi.'" method="get">'.$go.'<tr>
	<td class="remv"><div class="input-field"><i class="fa fa-angle-double-right prefix"></i>
	<input id="go" type="text" class="validate" name="hal" value="">
	<label for="go">Pergi Ke Halaman...</label></div></td><td class="remv">
	<div class="input-field">
	<button data-wow-delay=".5s" class="wow fadeInLeft btn-floating btn-large waves-effect waves-light green"
	data-container="body" data-toggle="popover" data-placement="right"
	data-trigger="hover" data-content="Pergi.."><i class="fa fa-angle-double-right"></i></button>
	</div></td></tr></form></table>';
	}

?>
<script>
$('#selectall').click(function(event) {
  if(this.checked) {
      // Iterate each checkbox
      $(':checkbox').each(function() {
          this.checked = true;
      });
  }
  else {
    $(':checkbox').each(function() {
          this.checked = false;
      });
  }
});

</script>