<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');

	$title	= 'Selamat Datang!';
	require_once $inc_dir.'head.php';
	
	echo '<p><h1 class="page-header">Selamat Datang, Silahkan Login terlebih dahulu!</h1></p>';
	require_once $inc_dir.'login.php';

	echo '	<p> <button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#modalLogin">Login</button></p>
			<div class="modal fade" id="modalLogin" role="dialog">
			<div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header text-center">
					<h4><i class="fa fa-user"></i> Login</h4>
				</div>
			<div class="modal-body" style="padding:40px 50px;">
				<div class="row">
								<form method="post" class="col-md-12">
					<div class="row">
							<div class="input-field">
						<i class="fa fa-user prefix"></i>
						<input value="'.$user.'" name="username" id="icon_email" type="tel" class="validate">
						<label for="icon_email">Nama User</label>
							</div>
						<input type="hidden" name="ref" value="'.$_SERVER['REQUEST_URI'].'" />
						<input type="hidden" name="submit" value="ok" />

							<div class="input-field">
						<i class="fa fa-lock prefix"></i>
						<input name="pass" value="'.$pass.'" id="password" type="password" class="validate">
						<label for="password">Kata Sandi</label>
							</div>
					<p>
						<input type="checkbox" id="test6" checked="checked" name="ingat" value="1"  />
						<label for="test6" data-toggle="tooltip" data-placement="left"
						data-original-title="Akan menyimpan Nama user dan Kata sandi pada browser">
						Ingatkan Saya</label>
					</p>
							<div class="text-center">
						<button type="submit" class="btn btn-primary waves-effect waves-light">Login</button>
							</div>
					</div>
								</form>
				</div>
			</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-default btn-default pull-left" data-dismiss="modal">X</button>
                </div>
            </div>
          
        </div>
    </div>';
	echo '<p><font color="#ff4444">';
	echo $errlog;
	echo '</font></p>';
?>