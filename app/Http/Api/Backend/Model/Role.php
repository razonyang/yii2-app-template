<?php
namespace App\Http\Api\Backend\Model;

use yii\rbac\Item;
use Yii;
use yii\validators\ExistValidator;

class Role extends AuthItem
{
    public $permission_names;

    public function rules()
    {
        return array_merge([
            ['type', 'default', 'value' => Item::TYPE_ROLE],
            ['type', 'in', 'range' => [Item::TYPE_ROLE]],
            ['permission_names', 'required'],
            [
                'permission_names', 'each',
                'rule' => ['exist', 'targetClass' => AuthItem::class, 'targetAttribute' => 'name', 'filter' => ['type' => Item::TYPE_PERMISSION]],
            ],
        ], parent::rules());
    }

    public function afterSave($insert, $changeAttributes)
    {
        parent::afterSave($insert, $changeAttributes);
        $this->savePermissions();
    }

    private function savePermissions()
    {
        if (empty($this->permission_names)) {
            return;
        }

        $auth = Yii::$app->getAuthManager();
        $role = $auth->getRole($this->name);
        $auth->removeChildren($role);
        foreach ($this->permission_names as $permissionName) {
            $auth->addChild($role, $auth->getPermission($permissionName));
        }
    }
    
    public function extraFields()
    {
        return [
            'permission_names' => 'permissionNames',
        ];
    }

    public function getPermissionNames(): array
    {
        $permissions = Yii::$app->getAuthManager()->getPermissionsByRole($this->name);
        return array_column($permissions, 'name');
    }
}
