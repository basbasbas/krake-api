<?php
namespace App;

//define('PAGES', 'pages');
//define('DATA', 'data');

class Config {
    const NAME = 'api';
    const PAGES = 'pages';
    const DATA = 'data';
}

return array(

    'prefixes' => array(
        'default' => Config::NAME,
        Config::PAGES => Config::PAGES,
        Config::DATA => Config::DATA
    ),

    // Define common data by key in data config
    'common_data' => array(
        'articles',
        'articles2'
    ),
    // Define common pages by key in data config
    'common_pages' => array(
        'articles',
        'articles2'
    ),

    Config::PAGES => array(
        'articles' => array(
            'views' => array(
                // Id that links to data item
                'id' => 'articles',
                'type' => 'listView',
                'amount' => 10,
                'sortBy' => array('date', 'ascending'),
                // Link attributes to view template
                'template' => array(
                    'title' => 'title',
                    'subtitle' => null,
                    'content' => 'content',
                )
            )
        ),
        'articles2' => array(
            'views' => array(
                // Id that links to data item
                'id' => 'articles',
                'type' => 'listView',
                'amount' => 10,
                'sortBy' => array('date', 'ascending'),
                // Link attributes to view template
                'template' => array(
                    'title' => 'title',
                    'subtitle' => null,
                    'content' => 'content',
                )
            ),
        )
    ),

    // General data request, on new connection
    // TODO; Implement user view options eg sort by, filter
    Config::DATA => array(
        // Array key below links to views
        'articles' => array(
            // Limit amount, sort etc
            'query' => 'SELECT * FROM article',
        ),
        'articles2' => array(
            // Limit amount, sort etc
            'query' => 'SELECT * FROM article',
        ),
//        'articles2' => array(
//            // Limit amount, sort etc
//            'query' => 'SELECT * FROM article',
//        )
    )

);




