<?php

namespace App\Http\Api\Backend\Module\V1;

use App\Http\Api\Module as ApiModule;

/**
 * v1 module definition class
 */
class Module extends ApiModule
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'App\Http\Api\Backend\Module\V1\Controller';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
