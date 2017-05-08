<?php

namespace App;

class ConfigParser
{
    private $config;

    private $pages;
    private $data;
    private $common_data;
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
        $this->common_data = $this->config['common_data'];

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
                    $array[$key]['id'] = $key;
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
    public function getDataByIds($ids) {
        return $this->getData($ids);
    }
    public function getDataById($id) {
        return $this->getData([$id]);
    }
    public function getCommonData() {
        return $this->getData();
    }
    public function getData($ids = null) {
        $ids = $ids == null ? $this->common_data : $ids;

        return $this->setData($ids);
    }
    private function setData($ids) {
        $obj = array();
        foreach($ids as $id) {
            if (array_key_exists($id, $this->data)) {
                $obj[$id] = $this->data[$id];
            }
        }
        return $obj;
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
