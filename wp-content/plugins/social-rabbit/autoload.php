<?php
/**
 * @author Maxim Doronin <maxim.doronin@itcode.pro>
 * @link itcode.pro
 */

spl_autoload_register(function($class) {
	$prefix = 'SR';
	$class = ltrim($class, '\\');
	$file = '';

	$len = strlen($prefix);

	if (strncmp($prefix, $class, $len) !== 0) {
		return;
	}

	if ($lastNsPos = strrpos($class, '\\')) {
		$namespace = substr($class, 0, $lastNsPos);
		$class = substr($class, $lastNsPos + 1);

		$file = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
		$file = str_replace($prefix, '', $file);
	}

	$file .= "{$class}.php";
	$file = __DIR__ . '/inc/' . $file;

	if (file_exists($file)) {
		require_once $file;
	}
});
