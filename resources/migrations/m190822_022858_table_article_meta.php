<?php
use App\Db\Migration;

/**
 * Class m190822_022858_table_article_meta
 */
class m190822_022858_table_article_meta extends Migration
{
    private $tableName = '{{%article_meta}}';

    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'article_id' => $this->integer()->notNull()->unique()->comment('Article ID'),
            'content' => $this->text()->notNull()->comment('Content'),
        ], $this->tableOptions());
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
