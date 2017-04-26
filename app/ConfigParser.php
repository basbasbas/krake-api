<?php

namespace App;

class ConfigParser
{
    private $config;

    private function __construct()
    {
        $this->config = include('Config.php');
    }

    public function get_config() {
        return $this->config;
    }

    // Singleton
    private function __clone() {}
    private function __wakeup() {}
    public static function Instance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new ConfigParser();
        }
        return $inst;
    }

    // List tables and types

    // Link URLs to correct config

}
