<?php
namespace App\Behavior;

use Yii;
use yii\base\ModelEvent;
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
                ActiveRecord::EVENT_BEFORE_VALIDATE => function (ModelEvent $event, $attribute) {
                    /** @var \yii\db\ActiveRecord $model */
                    $model = $event->sender;
                    return $model->getIsNewRecord() ? Yii::$app->getUser()->getId() : $model->$attribute;
                },
            ],
        ];
    }
}
