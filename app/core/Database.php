<?php
namespace DevNoKage;

use PDO;

class Database
{
    use Singleton;

    private ?PDO $pdo = null;

    private function __construct()
    {
        $dsn = sprintf(
            '%s:host=%s;port=%s;dbname=%s',
            DB_DRIVE,
            DB_HOST,
            DB_PORT,
            DB_NAME
        );

        $this->pdo = new PDO($dsn, DB_USER, DB_PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public function getConnexion(): PDO
    {
        return $this->pdo;
    }
}
