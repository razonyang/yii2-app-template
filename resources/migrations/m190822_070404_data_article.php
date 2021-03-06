<?php
use App\Db\Migration;

/**
 * Class m190822_070404_data_article
 */
class m190822_070404_data_article extends Migration
{
    private $tableName = '{{%article}}';

    private $metaTableName = '{{%article_meta}}';

    public function safeUp()
    {
        $now = time();
        $this->insert($this->tableName, [
            'id' => 1,
            'title' => 'Hello World',
            'creator' => 1,
            'author' => 'Administrator',
            'category_id' => 1,
            'summary' => 'Congratulation! You have set up Yii2 and Vue application successfully.',
            'cover' => '',
            'release_time' => $now,
            'create_time' => $now,
            'update_time' => $now,
        ]);

        $this->insert($this->metaTableName, [
            'article_id' => 1,
            'content' => '<p><strong>Congratulation!</strong> You have set up Yii2 and Vue application successfully.</p>',
        ]);
    }

    public function safeDown()
    {
        $this->truncateTable($this->tableName);
        $this->truncateTable($this->metaTableName);
    }
}
