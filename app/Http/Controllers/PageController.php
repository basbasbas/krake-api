<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfigParser;

class PageController extends Controller
{
    private $config;

    public function __construct()
    {
        $this->config = ConfigParser::Instance();
//        $this->config = $config->get_config();
    }

    public function setupPage(Request $request)
    {
        $page_config = $this->config->getPages()[$request->path()];

        $array = array(
            'url' => $request->path(),
            'client_url' => $page_config['client_url'],
//            'data' => app('db')->select($page_config['query']),
            'options' => $page_config['options']->get_data()
        );

        return json_encode($array);
    }

}
