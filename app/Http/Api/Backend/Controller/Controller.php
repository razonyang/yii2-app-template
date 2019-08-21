<?php
namespace App\Http\Api\Backend\Controller;

use App\Http\Rest\Controller as BaseController;
use yii\rest\OptionsAction;

class Controller extends BaseController
{
    use ControllerTrait;

    public function actions()
    {
        $acitons = parent::actions();

        $acitons['options'] = [
            'class' => OptionsAction::class,
        ];

        return $acitons;
    }
}
