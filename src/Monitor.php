<?php 

namespace src;

/**
 * Class Monitor
 *
 * @category PHP
 * @package
 * @author   Arno <arnoliu@tencent.com>
 */
class Monitor {

	protected static $root = './';

	protected static $source = DIRECTORY_SEPARATOR . 'source' . DIRECTORY_SEPARATOR;

	protected static $shuhui = array(
		'http://pic01.ishuhui.com/',
		'http://pic02.ishuhui.com/',
		'http://pic03.ishuhui.com/',
		'http://pic04.ishuhui.com/',
	);

	private function __construct() {
		//
	}

	public static function getCartoon($url) {
		$json = file_get_contents($url);

		is_array($json) || $json = json_decode($json, true);

		$uri = self::$shuhui;

		$title = $json['data']['title'];
		$book = $json['data']['book_text'];
		$number = $json['data']['number'];

		$path = realpath(self::$root) . self::$source . $book . DIRECTORY_SEPARATOR . $number . DIRECTORY_SEPARATOR;
		self::makeDir($path);

		$img_list = json_decode($json['data']['content_img'], true);
		foreach ($img_list as $num => $value) {
			$img_url = $uri[mt_rand(0, count($uri) - 1)] . substr($value, 8);

			$img = file_get_contents($img_url);

			$total_path = $path . $number . '-' . $num;

			self::getImg($total_path, $img);
		}
	}

	protected static function getImg($file, $img) {
		file_put_contents($file, $img);
	}

	protected static function makeDir($path) {
		if (realpath($path) === false) {
			$p = substr($path, 0, strrpos($path, DIRECTORY_SEPARATOR));

			var_dump($p);

			self::makeDir($p);
		}

		if (!is_dir($path)) {
			mkdir($path);
		}
	}
}

//end of script
