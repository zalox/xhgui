<?php
/**
* Default configuration for Xhgui
 */
$result = include($_SERVER['DOCUMENT_ROOT'] . '/sites/default/services.php');
$services = $result['services'];
$is_local = $result['is_local'];
$mongo_servers = $services['prod-mongo']['_ALL_'];
if (!$is_local) {
	$connections = [];
	foreach ($mongo_servers as $server) {
		$connections[] = $server['host'] . ':' . $server['port'];
	}
	$host = 'mongodb://' . implode(',', $connections);
} else {
	$host = 'mongodb://127.0.0.1:27017';
}

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
