<?php
/**
* Default configuration for Xhgui
 */
if ($_GET['db'] === 'xhprof_production') {
	setcookie('xhprof_production', '1', time() + 24 * 3600 * 3, '/', '.ftb-direct.com');
} else if ($_GET['db'] === 'xhprof') {
	setcookie('xhprof_production', '', time() - 3600, '/', '.ftb-direct.com');
	unset($_COOKIE['xhprof_production']);
}

$is_local = strpos($_SERVER['HTTP_HOST'], 'dw.com') !== false;
return array(
		'debug' => false,
		'mode' => 'development',

		// Can be either mongodb or file.
		'save.handler' => 'mongodb',

		// Needed for file save handler. Beware of file locking. You can adujst this file path
		// to reduce locking problems (eg uniqid, time ...)
		//'save.handler.filename' => __DIR__.'/../data/xhgui_'.date('Ymd').'.dat',
		'db.host' => !$is_local ? 'mongodb://mongo1b:27017' : 'mongodb://127.0.0.1:27017',
		'db.db' => 'xhprof',

		// Allows you to pass additional options like replicaSet to MongoClient.
		'db.options' => $is_local ? [] : ['replicaSet' => 'rs0'],
		'templates.path' => dirname(__DIR__) . '/src/templates',
		'date.format' => 'M jS H:i:s',
		'detail.count' => 6,
		'page.limit' => 25,

		// Profile 1 in 100 requests.
		// You can return true to profile every request.
		'profiler.enable' => function() {
			return $_GET['xprofile'] == 1;
		},

		'profiler.simple_url' => function($url) {
			return $url;
		}

);
