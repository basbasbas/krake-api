<?php

namespace App;

class ConfigParser
{
    private $config;

    private $pages;
    private $data;
    private $prefixes;
    private $types;

    const PAGES = 'pages';
    const DATA = 'data';

    private function __construct()
    {
        $this->config = require_once('Config.php');

        $this->types = array(
            self::PAGES => &$this->pages,
            self::DATA => &$this->data
        );

        $this->prefixes = $this->config['prefixes'];

        foreach ($this->types as $k => $v) {
            $this->format_config_data($k);
        }
    }

    private function format_config_data($type) {
        $this->types[$type] = $this->setUrlPrefixes($this->config[$type], $type);
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
        switch ($type) {
            case self::DATA:
                foreach ($array as $key => $value) {
                    $array[$key]['client_url'] = $key;
                }
                break;
            case self::PAGES:
                foreach ($array as $key => $value) {
                    $newKey = $this->prefixes['default'] . '/' . $this->prefixes[$type] . '/' . $key;

                    $array[$key]['client_url'] = $key;
                    $array[$newKey] = $array[$key];
                    unset($array[$key]);
                }
                break;
        }

        return $array;
    }

    public function getPages() {
        return $this->pages;
    }
    public function getPageUrls() {
        return array_keys($this->pages);
    }
    public function getData() {
        return $this->data;
    }
    public function getPrefixes() {
        return $this->prefixes;
    }
//    public function getConfig() {
//        return $this->config;
//    }

    // List tables and types

    // Link URLs to correct config

}
