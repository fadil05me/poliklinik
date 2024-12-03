<?php
if(!defined('MY_APP')) die('No direct access allowed to this page.');

$no = 1;
$s = mysql_query('SELECT * FROM pasien ORDER BY urutan DESC LIMIT 0, 3');
		while($get = mysql_fetch_array($s)) {
				$data .= '	<tr>
							<td class="wow bounceIn" data-wow-delay=".5s">'.$no.'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['Nopasien'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['Namapas'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['almpas'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['telppas'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.FlipDate($get['tgllahirpas'], 'dmy').'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.$get['jeniskelpas'].'</td>
							<td class="wow fadeIn" data-wow-delay=".3s">'.FlipDate($get['tglregistrasi'], 'dmy').'</td>
							</tr>';
	$no++;
			}
?>