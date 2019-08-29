<?php
use App\Db\Migration;

/**
 * Class m190829_053119_table_article_like
 */
class m190829_053119_table_article_like extends Migration
{
    private $tableName = '{{%article_like}}';

    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'article_id' => $this->integer()->notNull()->comment('Article ID'),
            'user_id' => $this->integer()->notNull()->comment('User ID'),
            'create_time' => $this->createTimestamp(),
        ], $this->tableOptions());

        $this->addPrimaryKey('article_like_pk', $this->tableName, ['article_id', 'user_id']);
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
