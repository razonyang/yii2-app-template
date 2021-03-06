<?php
namespace App\Http\Api\Backend\Controller;

use App\Http\Api\Backend\Model\Session;
use Yii;

class MySessionController extends SessionController
{
    public function getQuery($action)
    {
        return parent::getQuery($action)
            ->andWhere(['us.user_id' => Yii::$app->getUser()->getId()]);
    }

    public function findModelById($id, $action)
    {
        return Session::findOne([
            'id' => $id,
            'user_id' => Yii::$app->getUser()->getId(),
        ]);
    }
}
