<?php

require 'src/loader.php';

/**
 * 9082 9091
 *
 * @var 1000
 * @return 9131
 */

// $url = 'http://hhzapi.ishuhui.com/cartoon/post/ver/76906890/id/9130.json';

src\Monitor::$time = microtime(true);

$start = 600;
$end   = 800;

// $arr = array(
// 	7332, 7331
// );

// foreach ($arr as $key => $value) {
// 	$url = 'http://hhzapi.ishuhui.com/cartoon/post/ver/76906890/id/' . $value . '.json';

// 	run($url, $value);
// }
// die();

for ($i = $start; $i <= $end; $i++) {
	$url = 'http://hhzapi.ishuhui.com/cartoon/post/ver/76906890/id/' . $i . '.json';
	run($url, $i);
}

function run($url, $num) {
	src\Monitor::getCartoon($url);
	var_dump($num . ' end');
}

// end of script
