<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable('../');

$dotenv->load();

define('DB_HOST', $_ENV['DB_HOST'] ?? 'aws-0-eu-west-3.pooler.supabase.com');
define('DB_PORT', $_ENV['DB_PORT'] ?? '5432');
define('DB_DRIVE', $_ENV['DB_DRIVE'] ?? 'pgsql');
define('DB_USER', $_ENV['DB_USERNAME'] ?? 'postgres.numtenhayosqnztaahuv');
define('DB_PASSWORD', $_ENV['DB_PASSWORD'] ?? 'Astou0000');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'postgres');
define('METHODE_INSTANCE_NAME', $_ENV['METHODE_INSTANCE_NAME'] ?? '');
define('SERVICES_PATH', $_ENV['SERVICES_PATH'] ?? '');
