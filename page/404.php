<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');

$title = '404 Error Page Not Found';
require_once $inc_dir.'head.php';
echo '<h1 class="page-header">
            Error 404
        </h1>
		<p>Halaman tidak ditemukan, silakan cek Anda mengetik alamat dengan benar.</p>

		<p>Jika Anda percaya ini adalah sebuah kesalahan silahkan hubungi Administrator.</p>
		
<hr />
	    <p>Page not found, please check you typed the address correctly.</p>

        <p>
            If you believe this to be a mistake please contact Administrator.
        </p>
		
		<p align="center" style="margin:50px">
			<img class="materialboxed responsive-img" src="img/error.jpg">
		</p>';

?>