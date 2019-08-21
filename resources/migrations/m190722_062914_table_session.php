<?php
use App\Db\Migration;

/**
 * Class m190722_062914_table_session
 */
class m190722_062914_table_session extends Migration
{
    private $tableName = '{{%session}}';

    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->uuid(),
            'user_id' => $this->integer()->notNull()->comment('User ID'),
            'token' => $this->char(32)->notNull()->unique()->comment('Access Token'),
            'refresh_token' => $this->char(64)->notNull()->unique()->comment('Refresh Token'),
            'ip_address' => $this->ipAddress(),
            'user_agent' => $this->string()->notNull()->comment('User Agent'),

            'expire_time' => $this->timestamp('Expire Time'),
            'refresh_token_expire_time' => $this->timestamp('Refresh Token Expire Time'),
            'create_time' => $this->createTimestamp(),
            'update_time' => $this->updateTimestamp(),
        ], $this->tableOptions());

        $this->addPrimaryKey('session_pk', $this->tableName, ['id']);
        $this->createIndex('session_idx_user_id_expire_time', $this->tableName, ['user_id', 'expire_time']);
        $this->createIndex('session_idx_create_time', $this->tableName, ['create_time']);
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
