<?php
namespace App\Http\Api\Frontend;

use Yii;

/**
 * API module definition class
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'App\Http\Api\Frontend\Controller';

    public function init()
    {
        parent::init();

        // custom initialization code goes here

        $response = Yii::$app->getResponse();
        $response->format = 'json';
    }
}
