<?php
define('URL', 'http://localhost/onlineshop/');
define('ADMIN_URL', URL . 'admin/');

$basePath = realpath(dirname(__FILE__)) . '/';
define('BASE_PATH', $basePath);
define('LIBS', BASE_PATH.'libs/');

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'online_shop');
define('DB_USER', 'root');
define('DB_PASS', 'itcentar');

define('SMTP_SERVER', 'smtp.gmail.com');
define('SMTP_USER', 'milos.test.mail@gmail.com');
define('SMTP_PASSWORD', 'A3CSJnjs8D');
define('SMTP_PORT', '465');
define('SMTP_SSL', 1);