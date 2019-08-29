<?php
use App\Db\Migration;

/**
 * Class m190829_093604_article_comment
 */
class m190829_093604_article_comment extends Migration
{
    private $tableName = '{{%article_comment}}';

    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->bigPrimaryKey(),
            'reply_to' => $this->bigInteger()->notNull()->defaultValue(0)->comment('Reply To'),
            'article_id' => $this->integer()->notNull()->comment('Article ID'),
            'user_id' => $this->integer()->notNull()->comment('User ID'),
            'content' => $this->text()->notNull()->comment('Content'),
            'is_deleted' => $this->softDelete(),
            'create_time' => $this->createTimestamp(),
            'update_time' => $this->updateTimestamp(),
        ], $this->tableOptions());

        $this->createIndex('article_comment_idx_reply_to', $this->tableName, 'reply_to');
        $this->createIndex('article_comment_idx_article_id', $this->tableName, 'article_id');
        $this->createIndex('article_comment_idx_user_id', $this->tableName, 'user_id');
        $this->createIndex('article_comment_idx_create_time', $this->tableName, 'create_time');
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
