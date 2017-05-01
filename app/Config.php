<?php
namespace App;

$prefixes = array(
    'default' => 'api',
    'view' => 'view'
);

// TODO; Implement user view options eg sort by, filter

$views = array(
    'articles' => array(
        'query' => 'SELECT * FROM article',
        'viewOptions' => new ListView('title', null, 'content')
    ),
);

foreach ($views as $key => $value) {
    $views[$key]['client_url'] = $key;
}
$views = array_combine(
    array_map(function($k) use ($prefixes) { return $prefixes['default'].'/'.$prefixes['view'].'/'.$k; }, array_keys($views)),
    $views
);


return $views;
