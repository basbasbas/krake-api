<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfigParser;

class DataController extends Controller
{
    private $config;

    public function __construct()
    {
        $this->config = ConfigParser::Instance();
    }

    private function queryData($data) {
        // Return empty json if no data
        if (!$data) return (object) null;
        $queriedData = $data;

        foreach($queriedData as $key => $value) {
            if (array_key_exists($key, $queriedData) && array_key_exists('query', $queriedData[$key])) {
                $queriedData[$key]['data'] = app('db')->select($data[$key]['query']);
            }
        }

        return $queriedData;
    }

    public function setupCommonData(Request $request)
    {
        $data = $this->config->getCommonData();

        return $this->setupData($data);
    }
    public function setupDataByUrl(Request $request)
    {
        $data = $this->config->getDataByUrl($request->path());

        return $this->setupData($data);
    }
    public function setupDataByUrls(Request $request)
    {
    }
    private function setupData($data) {

        $obj = array();
        $formatted = array();

        $queriedData = $this->queryData($data);
        $json = json_encode($queriedData);

        return $json;
    }

}
