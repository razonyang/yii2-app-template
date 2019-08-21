<?php
use App\Db\Migration;
use App\Model\User;
use App\Model\StatusInterface;

/**
 * Class m190724_031648_data_user
 */
class m190724_031648_data_user extends Migration
{
    public function safeUp()
    {
        $now = time();
        $columns = [
            'username', 'first_name', 'last_name',
            'auth_key', 'password_hash', 'password_reset_token', 'email',
            'status', 'create_time', 'update_time',
        ];
        $rows = [
            [
                'Admin', 'Foo', 'Bar',
                '', Yii::$app->getSecurity()->generatePasswordHash('123456'), '', 'admin@example.com',
                StatusInterface::STATUS_ACTIVE, $now, $now,
            ],
        ];
        $this->batchInsert(User::tableName(), $columns, $rows);

        $auth = Yii::$app->getAuthManager();
        $auth->assign($auth->getRole('Administrator'), 1);
    }

    public function safeDown()
    {
        $this->delete(User::tableName(), ['username' => 'admin']);

        return true;
    }
}
