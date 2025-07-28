<?php
namespace DevNoKage;

trait Singleton
{
    private static ?self $instance = null;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();  // OK avec constructeur private de la classe qui utilise ce trait
        }
        return self::$instance;
    }

    // Empêcher clonage et unserialization
    private function __clone() {}
    private function __wakeup() {}
}
