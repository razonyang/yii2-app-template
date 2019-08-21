<?php
use App\Db\Migration;

/**
 * Class m190731_024219_table_article
 */
class m190731_024219_table_article extends Migration
{
    private $tableName = '{{%article}}';

    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('User ID'),
            'title' => $this->string()->notNull()->comment('Title'),
            'author' => $this->string()->notNull()->defaultValue('')->comment('Author'),
            'summary' => $this->string()->notNull()->comment('Summary'),
            'cover' => $this->string()->notNull()->comment('Cover'),
            'content' => $this->text()->notNull()->comment('Content'),
            'release_time' => $this->timestamp('Release Time'),
            'status' => $this->status(),
            'is_deleted' => $this->softDelete(),
            'create_time' => $this->createTimestamp(),
            'update_time' => $this->updateTimestamp(),
        ], $this->tableOptions());

        $this->createIndex('article_idx_user_id', $this->tableName, ['user_id']);
        $this->createIndex('article_idx_status', $this->tableName, ['status']);
        $this->createIndex('article_idx_is_deleted', $this->tableName, ['is_deleted']);
        $this->createIndex('article_idx_release_time', $this->tableName, ['release_time']);
    }
    
    public function safeDown()
    {
        $this->dropTable($this->tableName);

        return true;
    }
}
