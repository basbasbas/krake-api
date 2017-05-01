<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConfigParser;

class PageController extends Controller
{
    private $config;

    public function __construct()
    {
        $config = ConfigParser::Instance();
        $this->config = $config->get_config();
    }

    public function SetupPage(Request $request)
    {
        $page_config = $this->config[$request->path()];

        $array = array(
            'url' => $request->path(),
            'client_url' => $page_config['client_url'],
            'data' => app('db')->select($page_config['query']),
            'viewOptions' => $page_config['viewOptions']->get_data()
        );

        return json_encode($array);
    }

}
