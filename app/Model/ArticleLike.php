<?php

namespace App\Model;

use App\Behavior\CreatorBehavior;
use App\Behavior\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "{{%article_like}}".
 *
 * @property int $article_id Article ID
 * @property int $user_id User ID
 * @property int $create_time Create Time
 *
 * @property Article $article
 * @property User $user
 */
class ArticleLike extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%article_like}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => null,
            ],
            [
                'class' => CreatorBehavior::class,
                'creatorAttribute' => 'user_id',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id'], 'required'],
            [['article_id', 'create_time'], 'integer'],
            // [['article_id', 'user_id'], 'unique', 'targetAttribute' => ['article_id', 'user_id']],
            ['article_id', 'exist', 'targetClass' => Article::class, 'targetAttribute' => 'id'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'article_id' => Yii::t('app', 'Article ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'create_time' => Yii::t('app', 'Create Time'),
        ];
    }

    public function getArticle()
    {
        return $this->hasOne(Article::class, ['id' => 'article_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function findByArticleIdAndUserId(int $articleId, int $userId): ?self
    {
        return static::findOne([
            'article_id' => $articleId,
            'user_id' => $userId,
        ]);
    }
}
