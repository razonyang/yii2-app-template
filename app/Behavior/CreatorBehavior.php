<?php
namespace App\Behavior;

use Yii;
use yii\behaviors\AttributesBehavior;
use yii\db\ActiveRecord;

class CreatorBehavior extends AttributesBehavior
{
    public $creatorAttribute = 'creator';

    public function init()
    {
        parent::init();

        $this->attributes = [
            $this->creatorAttribute => [
                ActiveRecord::EVENT_BEFORE_INSERT => Yii::$app->getUser()->getId(),
            ],
        ];
    }
}
