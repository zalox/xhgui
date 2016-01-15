<?php
/**
* Default configuration for Xhgui
 */
require_once '/opt/graphiq/service_info/services.php';
$is_local = strpos($_SERVER['HTTP_HOST'], 'dw.com') !== false;
$mongo_servers = service_lookup('prod-mongo');
$connections = [];
foreach ($mongo_servers as $server) {
	$connections[] = $server['host'] . ':' . $server['port'];
}
$host = 'mongodb://' . implode(',', $connections);


return array(
		'debug' => false,
		'mode' => 'development',

		// Can be either mongodb or file.
		'save.handler' => 'mongodb',

		// Needed for file save handler. Beware of file locking. You can adujst this file path
		// to reduce locking problems (eg uniqid, time ...)
		//'save.handler.filename' => __DIR__.'/../data/xhgui_'.date('Ymd').'.dat',
		'db.host' => $host,
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
			return array_key_exists('xprofile', $_GET) && $_GET['xprofile'] == 1;
		},

		'profiler.simple_url' => function($url) {
			return $url;
		}

);
