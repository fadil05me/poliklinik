<?php
define('MY_APP',1);
	require_once 'inc/cnfg.php';
if(!$user_ck)
{
	require_once $p_dir.'login.php';
}
elseif($p && $user_ck){
	$menusel[$p] = ' class="stylish-color"';

	require_once $inc_dir.'auth.php';
	require_once $p_dir.'page.php';

}

elseif(!$p && $user_ck){
	require_once $inc_dir.'auth.php';
	$menusel['home'] = ' class="stylish-color"';
	require_once $p_dir.'awal.php';
}

	require_once $inc_dir.'foot.php';
?>
