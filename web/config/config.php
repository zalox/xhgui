<?php
function is_local() {
	$host = gethostname();
	return !(strpos($host, 'db') === 0 || strpos($host, 'web') === 0);
}

/**
 * Configuration for Xhgui
 */
return array(
    'db.host' => (is_local() ? 'mongodb://localhost:27017' : 'mongodb://10.188.21.221:27017'),
    'db.db' => 'xhprof',
    'date.format' => 'M jS H:i:s',
    'detail.count' => 6,
    'page.limit' => 25
);
