<?php

namespace App;

class ListView
{
    private $data;

    function getData() {
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
