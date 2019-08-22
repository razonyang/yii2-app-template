<?php
use App\Db\Migration;

/**
 * Class m190822_040321_add_column_category_id_to_article
 */
class m190822_040321_add_column_category_id_to_article extends Migration
{
    private $tableName = '{{%article}}';

    public function safeUp()
    {
        $this->addColumn($this->tableName, 'category_id', $this->integer()->notNull()->comment('Category ID'));
        $this->createIndex('article_idx_category_id', $this->tableName, 'category_id');
    }

    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'category_id');
    }
}
