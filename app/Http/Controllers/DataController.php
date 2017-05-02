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

    public function setupData(Request $request)
    {
        $data = $this->config->getData();
        $array = array();

        foreach($data as $key => $value) {
            $array[$key];

        }

        $array = array(
            'url' => $request->path(),
            'client_url' => $data['client_url'],
            'data' => app('db')->select($data['query']),
//            'viewOptions' => $page_config['viewOptions']->get_data()
        );

        return json_encode($array);
    }

}
