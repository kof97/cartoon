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

	public static $time;

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

		if (!isset($json['data'])) {
			is_dir('./log') || mkdir('./log');
			$log_file = './log/error-' . self::$time . '.log';
			file_put_contents($log_file, date('Y-m-d H:i:s') . ' - ' . $url . PHP_EOL, FILE_APPEND);
			return;
		}

		$title = $json['data']['title'];
		$book = $json['data']['book_text'];
		$number = $json['data']['number'];

		$path = realpath(self::$root) . self::$source . $book . DIRECTORY_SEPARATOR . $number . DIRECTORY_SEPARATOR;
		self::makeDir($path);

		$img_list = json_decode($json['data']['content_img'], true);
		if (empty($img_list)) {
			return;
		}

		foreach ($img_list as $num => $value) {
			$total_path = $path . $number . '-' . $num;

			if (is_file($total_path) && filesize($total_path) > 1000) {
				continue;
			}

			$img_url = $uri[mt_rand(0, count($uri) - 1)] . substr($value, 8);
			$img = file_get_contents($img_url);

			self::getImg($total_path, $img);
		}
	}

	protected static function getImg($file, $img) {
		if (!is_file($file)) {
			file_put_contents($file, $img);
		}
	}

	protected static function makeDir($path) {
		if (realpath($path) === false) {
			$p = substr($path, 0, strrpos($path, DIRECTORY_SEPARATOR));

			self::makeDir($p);
		}

		if (!is_dir($path)) {
			mkdir($path);
		}
	}
}

//end of script
