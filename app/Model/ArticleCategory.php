<?php
namespace App\Model;

use App\Behavior\ArticleCategoryBehavior;
use App\Behavior\CreatorBehavior;
use App\Behavior\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "{{%article_category}}".
 *
 * @property int $id
 * @property int $creator Creator ID
 * @property string $name Name
 * @property int $create_time Create Time
 * @property int $update_time Update Time
 */
class ArticleCategory extends ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            CreatorBehavior::class,
            ArticleCategoryBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%article_category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['create_time', 'update_time'], 'integer'],
            [['name'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'creator' => Yii::t('app', 'Creator'),
            'name' => Yii::t('app', 'Name'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    public function fields()
    {
        return [
            'id',
            'name',
            'create_time',
            'update_time',
        ];
    }
}
