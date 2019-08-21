<?php
namespace App\Http\Api\Backend\Model;

use yii\rbac\Item;

class Permission extends AuthItem
{
    public function rules()
    {
        return array_merge([
            ['type', 'default', 'value' => Item::TYPE_PERMISSION]
        ], parent::rules());
    }
}
