<?php
namespace App\Http\Api\Backend\Controller;

use App\Http\Api\Backend\Form\LoginForm;
use App\Http\Api\Backend\Form\LogoutForm;
use App\Http\Api\Backend\Form\SessionRefreshForm;
use App\Http\Api\Backend\Model\User;
use Yii;

class UserController extends ActiveController
{
    public $modelClass = User::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['optional'] = ['options', 'login', 'logout'];
        return $behaviors;
    }

    public function getPermission($action)
    {
        return 'user' . ucfirst($action);
    }

    public function actionLogin()
    {
        $form = new LoginForm();
        $form->load(Yii::$app->getRequest()->post(), '');
        return $form->handle();
    }

    public function actionRefreshAccessToken()
    {
        $form = new SessionRefreshForm();
        $form->load(Yii::$app->getRequest()->post(), '');
        return $form->handle();
    }

    public function actionLogout()
    {
        $form = new LogoutForm();
        return $form->handle();
    }

    public function searchModel()
    {
        return (new \yii\base\DynamicModel(['id', 'username' => null, 'email' => null, 'status' => null]))
            ->addRule(['id', 'status'], 'integer')
            ->addRule(['username', 'email'], 'trim')
            ->addRule(['username', 'email'], 'string');
    }

    protected function getQuery($action)
    {
        return parent::getQuery($action)
            ->alias('u')
            ->andWhere(['is_deleted' => 0])
            ->orderBy(['id' => SORT_DESC]);
    }

    protected function applyFilter($query, $model, $filter)
    {
        foreach (['id', 'username', 'email'] as $name) {
            if (!empty($model->$name)) {
                $query->andFilterWhere(['LIKE', 'u.' . $name, $model->$name]);
            }
        }

        if (is_numeric($model->status)) {
            $query->andWhere(['u.status' => intval($model->status)]);
        }
    }
}
