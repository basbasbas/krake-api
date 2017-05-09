<?php

namespace App;

class ConfigParser
{
    private $config;

    private $pages;
    private $data;
    private $common_data;
    private $common_pages;
    private $prefixes;
    private $types;
    private $commons;

    // Place in config.php
//    const PAGES = 'pages';
//    const DATA = 'data';

    private function __construct()
    {
        $this->config = require_once('Config.php');

        $this->types = array(
            Config::PAGES => &$this->pages,
            Config::DATA => &$this->data
        );
        $this->commons = array(
            Config::PAGES => &$this->common_pages,
            Config::DATA => &$this->common_data
        );

        $this->prefixes = $this->config['prefixes'];
        $this->common_data = $this->config['common_data'];
        $this->common_pages = $this->config['common_pages'];

        foreach ($this->types as $k => $v) {
            $this->format_config_data($k);
        }
    }

    private function format_config_data($type) {
        // Todo; better naming, this also sets types
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
//        $param = 'id';
//        switch ($type) {
//            case Config::DATA:    $param = 'id';          break;
//            case Config::PAGES:   $param = 'client_url';  break;
//        }
        foreach ($array as $key => $value) {
            $newKey = $this->getFullPrefixes()[$type] . '/' . $key;

            $array[$key]['id'] = $key;
            $array[$newKey] = $array[$key];
            unset($array[$key]);
        }

        return $array;
    }

    // Verbose functions
    public function getPages()          { return $this->pages; }
    public function getPageByUrl($url)  { return $this->filterByUrl(Config::PAGES, [$url]); }
    public function getCommonPages()    { return $this->filterById(Config::PAGES); }
    public function getData()           { return $this->data; }
    public function getPageUrls()       { return array_keys($this->pages); }
    public function getDataUrls()       { return array_keys($this->data); }
    public function getDataByUrls($urls){ return $this->filterByUrl(Config::DATA, $urls); }
    public function getDataByUrl($url)  { return $this->filterByUrl(Config::DATA, [$url]); }
    public function getDataByIds($ids)  { return $this->filterById(Config::DATA, $ids); }
    public function getDataById($id)    { return $this->filterById(Config::DATA, [$id]); }
    public function getCommonData()     { return $this->filterById(Config::DATA); }
    public function getPrefixes()       { return $this->prefixes; }

    public function getFullPrefixes() {
        return array(
            Config::DATA => $this->prefixes['default'] . '/' . $this->prefixes[Config::DATA],
            Config::PAGES => $this->prefixes['default'] . '/' . $this->prefixes[Config::PAGES]
        );
    }

    private function filterById($type, $ids = null) {
        $obj = array();
        $ids = $ids == null ? $this->commons[$type] : $ids;

        // Compare ids, place matches in new object
        foreach($ids as $id) {
            foreach($this->types[$type] as $k => $v) {
                if ($v['id'] == $id) {
                    $obj[$k] = $v;
                }
            }
        }

        return $obj;
    }
    private function filterByUrl($type, $urls = null) {
        if($urls == null) return (object) null;
        $obj = array();

        foreach($urls as $url) {
            foreach($this->types[$type] as $k => $v) {
                if ($k == $url) {
                    $obj[$k] = $v;
                }
            }
        }

        return $obj;
    }

    // List tables and types

    // Link URLs to correct config

}
