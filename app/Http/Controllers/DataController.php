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
            $queriedData[$key]['data'] = app('db')->select($data[$key]['query']);
        }

        return $queriedData;
    }

    public function setupCommonData(Request $request)
    {
        return json_encode($this->queryData($this->config->getCommonData()));
    }
    public function setupDataById($id, Request $request)
    {
        return json_encode($this->queryData($this->config->getDataById($id)));
    }

}
