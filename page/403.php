<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');

$title = '403 Forbidden';
require_once $inc_dir.'head.php';
echo '<h1 class="page-header">
            403 Forbidden
        </h1>
		<p>Anda tidak memiliki izin untuk mengakses URL atau tautan yang Anda minta.</p>

		<p>Jika Anda percaya ini adalah sebuah kesalahan silahkan hubungi Administrator.</p>
		
<hr />
	    <p>You do not have permission to retrieve the URL or link you requested.</p>

        <p>
            If you believe this to be a mistake please contact Administrator.
        </p>
		
		<p align="center" style="margin:50px">
			<img class="materialboxed responsive-img" src="img/403.png">
		</p>';

?>