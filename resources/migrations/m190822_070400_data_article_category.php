<?php
use App\Db\Migration;

/**
 * Class m190822_070400_data_article_category
 */
class m190822_070400_data_article_category extends Migration
{
    private $tableName = '{{%article_category}}';

    public function safeUp()
    {
        $columns = ['id', 'name', 'creator', 'create_time', 'update_time'];
        $now = time();
        $rows = [
            [1, 'News', 1, $now, $now],
        ];

        $this->batchInsert($this->tableName, $columns, $rows);
    }

    public function safeDown()
    {
        $this->truncateTable($this->tableName);
    }
}
