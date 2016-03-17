<?php
require dirname(__DIR__) . '/src/bootstrap.php';

spl_autoload_register(function ($class_name) {
	$class_name = str_replace('Mongofill\\', 'Mongofill/', $class_name);
	if (file_exists("../../mongofill/src/{$class_name}.php")) {
		require_once "../../mongofill/src/{$class_name}.php";
		require_once "../../mongofill/src/functions.php";
		return true;
	}
	return false;
});

$di = new Xhgui_ServiceContainer();

$app = $di['app'];

require XHGUI_ROOT_DIR . '/src/routes.php';

$app->run();
