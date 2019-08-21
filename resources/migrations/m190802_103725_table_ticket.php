<?php
use App\Db\Migration;

/**
 * Class m190802_103725_table_ticket
 */
class m190802_103725_table_ticket extends Migration
{
    private $tableName = '{{%ticket}}';

    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->char(64),
            'create_time' => $this->createTimestamp(),
            'update_time' => $this->updateTimestamp(),
        ], $this->tableOptions());

        $this->createIndex('ticket_pk', $this->tableName, ['id']);
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);

        return true;
    }
}
