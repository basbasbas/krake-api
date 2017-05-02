<?php

namespace App;

class ConfigParser
{
    private $config;

    private $pages;
    private $data;
    private $prefixes;

    private function __construct()
    {
        $this->config = require_once('Config.php');

        $this->prefixes = $this->config['prefixes'];
        $this->pages = $this->config['pages'];
        $this->data = $this->config['data'];

        $this->prefixes['view'] = $this->prefixes['default'] . '/' . $this->prefixes['view'];
        $this->prefixes['data'] = $this->prefixes['default'] . '/' . $this->prefixes['data'];
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

    // Add client url as seperate prop
    // Replace client url with server url
    private function setUrlPrefixes($array, $type) {
        foreach ($array as $key => $value) {
            if ($type == 'data') {
                $newKey = $this->prefixes[$type];
            } else {
                $newKey = $this->prefixes[$type] . '/' . $key;
            }

            $array[$key]['client_url'] = $key;
            $array[$newKey] = $array[$key];
            unset($array[$key]);
        }

        return $array;
    }
    public function getPages() {
        return $this->setUrlPrefixes($this->pages, 'view');
    }
    public function getData() {
        return $this->setUrlPrefixes($this->data, 'data');
    }

    // List tables and types

    // Link URLs to correct config

}
