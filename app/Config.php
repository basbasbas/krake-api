<?php
namespace App;

return array(

    'prefixes' => array(
        'default' => 'api',
        'pages' => 'pages',
        'data' => 'data'
    ),

    'pages' => array(
        'articles' => array(
            'options' => new ListView(array(
                // Id that links to data item
                'id' => 'articles',
                'amount' => 10,
                'sortBy' => array('date', 'ascending'),
                // Link attributes to view template
                'template' => array(
                    'title' => 'title',
                    'subtitle' => null,
                    'content' => 'content',
                ))
            )
        )
    ),

    // General data request, on new connection
    // TODO; Implement user view options eg sort by, filter
    'data' => array(
        // Array key below links to views
        'articles' => array(
            // Limit amount, sort etc
            'query' => 'SELECT * FROM article',
        ),
//        'articles2' => array(
//            // Limit amount, sort etc
//            'query' => 'SELECT * FROM article',
//        )
    )

);




