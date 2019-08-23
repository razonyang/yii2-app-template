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
            'category_id' => $this->integer()->notNull()->comment('Category ID'),
            'creator' => $this->integer()->notNull()->comment('Creator ID'),
            'title' => $this->string()->notNull()->comment('Title'),
            'author' => $this->string()->notNull()->defaultValue('')->comment('Author'),
            'summary' => $this->string()->notNull()->comment('Summary'),
            'cover' => $this->string()->notNull()->comment('Cover'),
            'status' => $this->status(),
            'is_deleted' => $this->softDelete(),
            'views' => $this->integer()->unsigned()->notNull()->defaultValue(0),
            'version' => $this->optimisticLock(),
            'release_time' => $this->timestamp('Release Time'),
            'create_time' => $this->createTimestamp(),
            'update_time' => $this->updateTimestamp(),
        ], $this->tableOptions());

        $this->createIndex('article_idx_creator', $this->tableName, ['creator']);
        $this->createIndex('article_idx_status', $this->tableName, ['status']);
        $this->createIndex('article_idx_is_deleted', $this->tableName, ['is_deleted']);
        $this->createIndex('article_idx_release_time', $this->tableName, ['release_time']);
        $this->createIndex('article_idx_category_id', $this->tableName, 'category_id');
    }
    
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
