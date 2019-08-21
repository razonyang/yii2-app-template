<?php
namespace App\Http\Api\Backend\Model;

use App\Model\User as BaseUser;
use Yii;
use yii\helpers\ArrayHelper;

class User extends BaseUser
{
    public $role_names;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['role_names'], 'required'],
            ['role_names', 'each', 'rule' => ['validateRole']],
        ]);
    }

    public function validateRole($attribute)
    {
        $roleName = $this->$attribute;
        if (!Yii::$app->getAuthManager()->getRole($roleName)) {
            $this->addError($attribute, Yii::t('yii', '{attribute} is invalid.', [
                'attribute' => sprintf("%s '%s'", $this->getAttributeLabel($attribute), $roleName)
            ]));
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $this->saveRoles();
    }
    
    private function saveRoles()
    {
        if (empty($this->role_names)) {
            return;
        }
        
        $auth = Yii::$app->getAuthManager();
        // revoke
        $auth->revokeAll($this->id);
        // assign
        foreach ($this->role_names as $name) {
            $auth->assign($auth->getRole($name), $this->id);
        }
    }

    public function extraFields()
    {
        return [
            'roles',
            'role_names' => 'roleNames',
        ];
    }

    public function getRoles()
    {
        $roles = Yii::$app->getAuthManager()->getRolesByUser($this->id);
        return ArrayHelper::getColumn($roles, function ($element) {
            return [
                'name' => $element->name,
                'description' => $element->description,
            ];
        }, false);
    }

    public function getRoleNames()
    {
        $roles = Yii::$app->getAuthManager()->getRolesByUser($this->id);
        return array_column($roles, 'name');
    }
}
