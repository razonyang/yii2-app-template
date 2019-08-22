<?php
namespace App\Model;

use App\Behavior\ArticleBehavior;
use App\Db\TimestampBehavior;
use App\Factory\ArticleMetaFactory;
use App\Validator\UrlValidator;
use Yii;
use yii\behaviors\OptimisticLockBehavior;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property int $id
 * @property int $user_id User ID
 * @property string $title Title
 * @property string $summary Description
 * @property string $author Author
 * @property string $cover Cover
 * @property int $release_time Release Time
 * @property int $status Status: 0.Inactive 1.Active
 * @property int $is_deleted Is Deleted
 * @property int $create_time Create Time
 * @property int $update_time Update Time
 *
 * @property ArticleMeta $meta
 */
class Article extends ActiveRecord implements SoftDeleteInterface, StatusInterface
{
    use SoftDeleteTrait, StatusTrait;

    public $content;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            OptimisticLockBehavior::class,
            ArticleBehavior::class,
        ];
    }
    
    public function optimisticLock()
    {
        return 'version';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author', 'cover'], 'default', 'value' => ''],
            [['user_id', 'title', 'content', 'summary', 'status', 'release_time'], 'required'],
            [['user_id', 'release_time', 'status', 'is_deleted', 'create_time', 'update_time'], 'integer'],
            [['content'], 'string'],
            [['title', 'author'], 'string', 'max' => 255],
            [['cover'], UrlValidator::class],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'cover' => Yii::t('app', 'Cover'),
            'title' => Yii::t('app', 'Title'),
            'summary' => Yii::t('app', 'Summary'),
            'content' => Yii::t('app', 'Content'),
            'author' => Yii::t('app', 'Author'),
            'release_time' => Yii::t('app', 'Release Time'),
            'status' => Yii::t('app', 'Status: 0.Inactive 1.Active'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    public function getMeta()
    {
        return $this->hasOne(ArticleMeta::class, ['article_id' => 'id']);
    }
}
