<?php
namespace App;

return array (

    'prefixes' => array(
        'default' => 'api',
        'view' => 'view',
        'data' => 'data'
    ),

    'pages' => array(
        'articles' => array(
            'options' => new ListView(
                // Id that links to data item
                'articles',
                // Link attributes to view template
                'title',
                null,
                'content'
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
            //        'viewOptions' => new ListView('title', null, 'content')
        ),
    )

);




