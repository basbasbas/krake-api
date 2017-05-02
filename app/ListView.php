<?php

namespace App;

class ListView
{
    private $data;

    function get_data() {
        return $this->data;
    }

    // TODO; Change class to method?
    function __construct($title, $subtitle, $content)
    {
        $this->data = array(
            'view' => 'listView',
            'options' => array(
                'id' => $id,
                'title' => $title,
                'subtitle' => $subtitle,
                'content' => $content,
            )
        );
    }

}
