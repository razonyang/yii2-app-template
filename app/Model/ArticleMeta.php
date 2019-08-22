<?php
namespace App\Model;

use Yii;

/**
 * This is the model class for table "{{%article_meta}}".
 *
 * @property int $article_id Article ID
 * @property string $content Content
 *
 * @property Article $article
 */
class ArticleMeta extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%article_meta}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id'], 'required'],
            [['article_id'], 'integer'],
            [['content'], 'string'],
            [['article_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'article_id' => Yii::t('app', 'Article ID'),
            'content' => Yii::t('app', 'Content'),
        ];
    }

    public function getArticle()
    {
        return $this->hasOne(Article::class, ['id' => 'article_id']);
    }
}
