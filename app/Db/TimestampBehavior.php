<?php
namespace App\Db;

use yii\behaviors\TimestampBehavior as Behavior;

class TimestampBehavior extends Behavior
{
    public $createdAtAttribute = 'create_time';

    public $updatedAtAttribute = 'update_time';
}
