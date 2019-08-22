<?php
use App\Db\Migration;

/**
 * Class m190822_034841_table_article_category
 */
class m190822_034841_table_article_category extends Migration
{
    private $tableName = '{{%article_category}}';

    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'creator' => $this->integer()->notNull()->comment('Creator ID'),
            'name' => $this->string(32)->notNull()->comment('Name'),
            'create_time' => $this->createTimestamp(),
            'update_time' => $this->updateTimestamp(),
        ], $this->tableOptions());

        $this->createIndex('article_category_idx_creator', $this->tableName, ['creator']);
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
