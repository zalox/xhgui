<?php
/**
* Default configuration for Xhgui
 */
return array(
		'debug' => false,
		'mode' => 'development',

		// Can be either mongodb or file.
		'save.handler' => 'mongodb',

		// Needed for file save handler. Beware of file locking. You can adujst this file path
		// to reduce locking problems (eg uniqid, time ...)
		//'save.handler.filename' => __DIR__.'/../data/xhgui_'.date('Ymd').'.dat',
		'db.host' => (!strpos($_SERVER['HTTP_HOST'], 'dw.com')) ? 'mongodb://10.174.77.212:27017' : 'mongodb://127.0.0.1:27017',
		'db.db' => ($_GET['db'] ? : ((gethostname() == 'web3') ? 'xhprof_production' : 'xhprof')),

		// Allows you to pass additional options like replicaSet to MongoClient.
		'db.options' => array(),
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
