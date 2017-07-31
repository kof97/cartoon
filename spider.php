<?php

require 'src/loader.php';

$json = $_GET['json'];

$uri = array(
	'http://pic01.ishuhui.com/',
	'http://pic02.ishuhui.com/',
	'http://pic03.ishuhui.com/',
	'http://pic04.ishuhui.com/',
);

is_array($json) || $json = json_decode($json, true);

$title = $json['data']['title'];
$book = $json['data']['book_text'];
$number = $json['data']['number'];

$img_list = json_decode($json['data']['content_img'], true);
foreach ($img_list as $num => $value) {
	$img_url = $uri[mt_rand(0, count($uri) - 1)] . substr($value, 8);


	// file_put_contents('./aaa.png', $img);
}

// end of script
