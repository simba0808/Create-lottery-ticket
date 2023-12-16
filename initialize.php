<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(!defined('BASE_URL')) define('BASE_URL', 'http://localhost/');
if(!defined('BASE_APP')) define('BASE_APP', str_replace('\\','/',__DIR__).'/' );
if(!defined('DB_SERVER')) define('DB_SERVER', 'localhost');
if(!defined('DB_USERNAME')) define('DB_USERNAME', 'root');
if(!defined('DB_PASSWORD')) define('DB_PASSWORD', 'dreamhigh');
if(!defined('DB_NAME')) define('DB_NAME', 'u857437926_biel');
?>