<?php

namespace App;

return array(

    'articles' => array(
        'query' => 'SELECT * FROM article',
        'viewOptions' => new ListView('title', null, 'content')
    ),

);
