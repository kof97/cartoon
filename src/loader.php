<?php
/**
 * AutoLoader
 *
 * @category PHP
 * @author   Arno <arnoliu@tencent.com>
 */

defined('ROOT_PATH') || define('ROOT_PATH', dirname(__DIR__));

class Loader {
	/**
	 * Auto loader the class.
	 *
	 * @param string $class Class name.
	 *
	 * @return void
	 */
	public static function load($class) {
		$prefix = 'src\\';

		$len = strlen($prefix);
		if (strncmp($prefix, $class, $len) !== 0) {
			// Another namespace.
			return;
		}

		$class_name = substr($class, $len);

		$file = __DIR__ . DIRECTORY_SEPARATOR . strtr($class_name, '\\', DIRECTORY_SEPARATOR) . '.php';

		if (is_file($file)) {
			require $file;
		}
	}
}

spl_autoload_register(array('Loader', 'load'));

function auto_doc_error($errno, $errmsg, $file, $line) {
	echo 'mod: ' . src\Doc::$traceInfo['inner_mod'] . PHP_EOL;
	echo 'act: ' . src\Doc::$traceInfo['inner_act'] . PHP_EOL;
	echo 'param: ' . src\Doc::$traceInfo['param'] . PHP_EOL;
	echo 'sub_param: ' . src\Doc::$traceInfo['sub_param'] . PHP_EOL;
	echo '错误级别: ' . $errno . PHP_EOL;
	echo '错误文件: ' . $file . PHP_EOL;
	echo '错误行号: ' . $line . PHP_EOL;
	echo '错误信息: ' . $errmsg . PHP_EOL;
	die;
}

// set_error_handler('auto_doc_error', E_ALL);

// end of script
