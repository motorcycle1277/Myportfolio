<?php
$db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
$db['dbname'] = ltrim($db['path'], '/');
define('DSN',"mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8");
define('DB_USER',"$db['user']");
define('DB_PASS',"$db['pass']");
