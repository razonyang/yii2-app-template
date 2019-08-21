<?php
namespace App\Http\Api\Backend\Controller;

use App\Http\Api\Backend\Form\MyInfoForm;
use App\Http\Api\Backend\Form\ChangePasswordForm;
use Yii;

class MyController extends Controller
{
    public function actionInfo()
    {
        $form = new MyInfoForm();
        return $form->handle();
    }

    public function actionPassword()
    {
        $form = new ChangePasswordForm();
        $form->load(Yii::$app->getRequest()->post(), '');
        return $form->handle();
    }
}
