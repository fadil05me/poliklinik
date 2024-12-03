<?php

//-- Config --//

// -- Judul --//
	$title	= 'Menampilkan Data Tabel '.$p;
	
	
// -- Require File Header -- //
require_once $inc_dir.'head.php';


// -- Require File Pencarian (inc/search.php) -- //
require_once 'inc/search.php';


// -- Phal = jumlah data per halaman  -- //
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




// -- Kondisi Jika User sedang menggunakan Pencarian -- //
if($cari){

	$num	= hitungdata('SELECT kodejadwal, COUNT(kodejadwal) AS jumlahdata FROM '.$p.' WHERE '.dbres($tipe).' LIKE "%'.dbres($cari).'%"');
	$s		= mysql_query('SELECT * FROM '.$p.' WHERE '.dbres($tipe).' LIKE "%'.dbres($cari).'%" LIMIT '.$start.', '.$phal);

}

else{
	$num	= hitungdata('SELECT kodejadwal, COUNT(kodejadwal) AS jumlahdata FROM '.$p);
	$s		= mysql_query('SELECT * FROM '.$p.' LIMIT '.dbres($start).', '.$phal);

}






		if($cari){
	$a		= 'Ditemukan '.$num.' Data';
		}
	else{
	$a		= 'Total Data '.$p.': '.$num;
	}




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

	echo '	<nav><ul class="pager"><li class="previous'.$lclass.'"><a href="'.$backx.'">
			<span aria-hidden="true">&larr;</span> Sebelumnya</a></li>
			Halaman ke '.$hal.' dari Total Halaman: '.$thal.'<li class="next'.$rclass.'">
			<a href="'.$nextx.'"><span aria-hidden="true">&rarr;</span> Selanjutnya</a></li></ul></nav>';
			
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