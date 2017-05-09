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

    public function setupCommonPages(Request $request) {
        $pages = $this->config->getCommonPages();
//        $array = array();
//
//        foreach ($pages as $page) {
//            array_push($array, $this->setupPage($page));
//        }
        return json_encode($pages);
    }

    public function setupPageByUrls(Request $request) {

    }

    public function setupPageByUrl(Request $request) {
        $page = $this->config->getPageByUrl($request->path());
//        $page_config = $this->config->getPages()[$request->path()];
//        $array = $this->setupPage($request, $page_config);

        return json_encode($page);
    }

    // TODO; replace this function to configparser / thin controller
//    private function setupPage($request, $config) {
//        $views = array();
//
//        foreach($config['views'] as $view) {
//            array_push($views, $view->getData());
//        }
//
//        return array(
//            'url' => $request->path(),
//            'id' => $config['id'],
//            'options' => $views
//        );
//    }

}
