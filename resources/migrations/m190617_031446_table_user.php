<?php
use App\Db\Migration;

/**
 * Class m190617_031446_table_user
 */
class m190617_031446_table_user extends Migration
{
    private $tableName = '{{%user}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'first_name' => $this->string()->notNull()->defaultValue('')->comment('First Name'),
            'last_name' => $this->string()->notNull()->defaultValue('')->comment('Last Name'),
            'avatar' => $this->string()->notNull()->defaultValue('')->comment('Avatar'),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'verification_token' => $this->string()->defaultValue(null),
            'language' => $this->string(5)->notNull()->defaultValue('en'),

            'status' => $this->status(),
            'is_deleted' => $this->softDelete(),
            'create_time' => $this->createTimestamp(),
            'update_time' => $this->updateTimestamp(),
        ], $this->tableOptions());

        $this->createIndex('user_idx_status', $this->tableName, ['status']);
        $this->createIndex('user_idx_is_deleted', $this->tableName, ['is_deleted']);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
