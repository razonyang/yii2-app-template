<?php
namespace App\Http\Api;

use Yii;

/**
 * API module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'App\Http\Api\Controller';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here

        $response = Yii::$app->getResponse();
        $response->format = 'json';
    }
}
