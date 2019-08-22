<?php
use App\Db\Migration;
use App\Rbac\Rule\UserDeleteRule;
use App\Rbac\Rule\RoleDeleteRule;

/**
 * Class m190724_022733_auth_init
 */
class m190724_022733_auth_init extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->getAuthManager();

        $userDeleteRule = new UserDeleteRule();
        $roleDeleteRule = new RoleDeleteRule();
        $rules = [
            $userDeleteRule, $roleDeleteRule,
        ];
        foreach ($rules as $rule) {
            $auth->add($rule);
        }

        $permissions = [
            'userIndex' => [
                'description' => 'User List',
            ],
            'userCreate' => [
                'description' => 'Create User',
            ],
            'userView' => [
                'description' => 'View User',
            ],
            'userUpdate' => [
                'description' => 'Edit User',
                'children' => ['userView'],
            ],
            'userDelete' => [
                'description' => 'Delete User',
                'rule' => $userDeleteRule->name,
            ],
            'userManagement' => [
                'description' => 'User Management',
                'children' => ['userIndex', 'userCreate', 'userUpdate', 'userView', 'userDelete'],
            ],

            'roleIndex' => [
                'description' => 'Role List',
            ],
            'roleCreate' => [
                'description' => 'Create Role',
            ],
            'roleView' => [
                'description' => 'View Role',
            ],
            'roleUpdate' => [
                'description' => 'Edit Role',
                'children' => ['roleView'],
            ],
            'roleDelete' => [
                'description' => 'Delete Role',
                'rule' => $roleDeleteRule->name,
            ],
            'roleManagement' => [
                'description' => 'Role Management',
                'children' => ['roleIndex', 'roleCreate', 'roleUpdate', 'roleView', 'roleDelete'],
            ],

            'articleIndex' => [
                'description' => 'Article List',
            ],
            'articleCreate' => [
                'description' => 'Create Article',
            ],
            'articleView' => [
                'description' => 'View Article',
            ],
            'articleUpdate' => [
                'description' => 'Edit Article',
                'children' => ['articleView'],
            ],
            'articleDelete' => [
                'description' => 'Delete Article',
                'rule' => $roleDeleteRule->name,
            ],
            'articleManagement' => [
                'description' => 'Article Management',
                'children' => ['articleIndex', 'articleCreate', 'articleUpdate', 'articleView', 'articleDelete'],
            ],

            'articleCategoryIndex' => [
                'description' => 'Article Category List',
            ],
            'articleCategoryCreate' => [
                'description' => 'Create Article Category',
            ],
            'articleCategoryView' => [
                'description' => 'View Article Category',
            ],
            'articleCategoryUpdate' => [
                'description' => 'Edit Article Category',
                'children' => ['articleView'],
            ],
            'articleCategoryDelete' => [
                'description' => 'Delete Article Category',
            ],
            'articleCategoryManagement' => [
                'description' => 'Article Category Management',
                'children' => ['articleCategoryIndex', 'articleCategoryCreate', 'articleCategoryUpdate', 'articleCategoryView', 'articleCategoryDelete'],
            ],

            'settingIndex' => [
                'description' => 'Setting List',
            ],
            'settingView' => [
                'description' => 'View Setting',
            ],
            'settingUpdate' => [
                'description' => 'Edit Setting',
                'children' => ['settingView'],
            ],
            'settingManagement' => [
                'description' => 'Setting Management',
                'children' => ['settingIndex', 'settingView', 'settingUpdate'],
            ],
        ];

        foreach ($permissions as $name => $params) {
            $permission = $auth->createPermission($name);
            $permission->description = $params['description'];
            if (isset($params['rule'])) {
                $permission->ruleName = $params['rule'];
            }
            $auth->add($permission);
            if (isset($params['children'])) {
                foreach ($params['children'] as $child) {
                    $auth->addChild($permission, $auth->getPermission($child));
                }
            }
        }

        $roles = [
            'Administrator' => [
                'description' => 'Administrator',
                'permissions' => ['userManagement', 'roleManagement', 'articleManagement', 'articleCategoryManagement', 'settingManagement'],
            ],
            'User' => [
                'description' => 'User',
                'permissions' => [],
            ],
        ];
        foreach ($roles as $name => $params) {
            $role = $auth->createRole($name);
            $role->description = $params['description'];
            $auth->add($role);
            if (isset($params['permissions'])) {
                foreach ($params['permissions'] as $permissionName) {
                    $auth->addChild($role, $auth->getPermission($permissionName));
                }
            }
        }
    }

    public function safeDown()
    {
        $auth = Yii::$app->getAuthManager();
        $auth->removeAll();
    }
}
