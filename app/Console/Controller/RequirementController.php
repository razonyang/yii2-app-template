<?php
namespace App\Console\Controller;

use Yii;

class RequirementController extends Controller
{
    public function actionIndex()
    {
        require Yii::getAlias('@resources/requirements.php');
    }
}
