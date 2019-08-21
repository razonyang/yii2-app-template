<?php
namespace App\Http\Rest;

use yii\rest\Controller as BaseController;

class Controller extends BaseController
{
    public $serializer = Serializer::class;
}
