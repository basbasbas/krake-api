<?php

namespace App;

class ListView
{
    private $data;

    function get_data() {
        return $this->data;
    }

    // TODO; Change class to method?
    function __construct($options)
    {
        $this->data = array(
            'view' => 'listView',
            'options' => $options
        );
    }

}
