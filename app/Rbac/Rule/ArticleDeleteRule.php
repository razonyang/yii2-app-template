<?php
namespace App\Rbac\Rule;

use Yii;
use yii\rbac\Rule;

class ArticleDeleteRule extends Rule
{
    public $name = 'articleDelete';

    public function execute($user, $item, $params)
    {
        return isset($params['model']) ? $user == $params['model']->user_id : false;
    }
}
