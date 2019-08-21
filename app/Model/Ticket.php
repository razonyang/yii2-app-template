<?php

namespace App\Model;

use App\Db\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "{{%ticket}}".
 *
 * @property string $id UUID
 * @property int $create_time Create Time
 * @property int $update_time Update Time
 */
class Ticket extends \App\Model\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ticket}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_time', 'update_time'], 'integer'],
        ];
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->id = Yii::$app->security->generateRandomString(64);
        }

        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'UUID'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }
}
