<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable('../');

$dotenv->load();

define('DB_HOST', $_ENV['DB_HOST'] ?? 'caboose.proxy.rlwy.net');
define('DB_PORT', $_ENV['DB_PORT'] ?? '48451');
define('DB_DRIVE', $_ENV['DB_DRIVE'] ?? 'pgsql');
define('DB_USER', $_ENV['DB_USER'] ?? 'postgres');
define('DB_PASSWORD', $_ENV['DB_PASSWORD'] ?? 'RbQUnUCXscZgrBcBUqtqYIIOfsbgNYqi');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'railway');
define('METHODE_INSTANCE_NAME', $_ENV['METHODE_INSTANCE_NAME'] ?? 'getInstance');
define('SERVICES_PATH', $_ENV['SERVICES_PATH'] ?? '../app/config/services.yml');
