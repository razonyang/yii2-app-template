<?php

namespace App\Model;

use Yii;

/**
 * This is the model class for table "{{%article_comment}}".
 *
 * @property int $id
 * @property int $reply_to Reply To
 * @property int $article_id Article ID
 * @property int $user_id User ID
 * @property string $content Content
 * @property int $is_deleted Is Deleted
 * @property int $create_time Create Time
 * @property int $update_time Update Time
 *
 * @property Article $article
 * @property User $user
 */
class ArticleComment extends \App\Model\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%article_comment}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => CreatorBehavior::class,
                'creatorAttribute' => 'user_id',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reply_to', 'article_id', 'user_id', 'is_deleted', 'create_time', 'update_time'], 'integer'],
            [['article_id', 'user_id', 'content'], 'required'],
            [['content'], 'string'],
            ['article_id', 'exist', 'targetClass' => Article::class, 'targetAttribute' => 'id'],
            ['user_id', 'exist', 'targetClass' => User::class, 'targetAttribute' => 'id'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'reply_to' => Yii::t('app', 'Reply To'),
            'article_id' => Yii::t('app', 'Article ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'content' => Yii::t('app', 'Content'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
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
}
