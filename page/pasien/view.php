<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');

//-- Config --//

// -- Judul --//
	$title	= 'Menampilkan Data Tabel '.$p;
	
	
// -- Require File Header -- //
require_once $inc_dir.'head.php';


// -- Require File Pencarian (inc/search.php) -- //
require_once 'inc/search.php';

	
// -- Require File paging.php, untuk membuat halaman -- //
require_once 'inc/paging.php';	
		
	
// -- Require File data.php, isinya untuk menampilkan data pada tabel -- //
require_once 'inc/data.php';


	
	$pgr	= '	<nav><ul class="pager"><li class="previous'.$lclass.'">
				<a href="'.$backx.'"><span aria-hidden="true">&larr;</span> Sebelumnya</a></li>
				Halaman ke '.$hal.' dari Total Halaman: '.$thal.'
				<li class="next'.$rclass.'"><a href="'.$nextx.'"><span aria-hidden="true">&rarr;</span> Selanjutnya</a></li></ul></nav>';
			

	
	$goto	= '	<table><form action="'.$turi.'" method="get">'.$go.'<tr>
				<td class="remv"><div class="input-field"><i class="fa fa-angle-double-right prefix"></i>
				<input id="go" type="text" class="validate" name="hal" value="">
				<label for="go">Pergi Ke Halaman...</label></div></td><td class="remv">
				<div class="input-field">
				<button class="btn btn-primary">
				<i class="fa fa-angle-double-right"></i></button>
				</div></td></tr></form></table>';
	
	
	// -- Echo -- //
	// -- $datav dari file data.php, $pgr dari file paging.php -- //
	
	echo my_messages_to_user().$datav.$pgr.$goto;
	

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