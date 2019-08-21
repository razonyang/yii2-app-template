<?php
namespace App\Helper;

use Yii;
use yii\db\Connection;

class DbHelper
{
    /**
     * Commits transaction when successed, otherwise rollbacks transaction and rethrow exception.
     *
     * @param \Closure       $callback
     * @param array          $parameters
     * @param null|onnection $db
     * @param null|string    $isolationLevel
     *
     * @throws \Throwable
     */
    public static function transaction(\Closure $callback, array $parameters = [], ?Connection $db = null, ?string $isolationLevel = null)
    {
        $db = $db ?? Yii::$app->getDb();
        $transaction = $db->beginTransaction($isolationLevel);
        try {
            call_user_func_array($callback, $parameters);

            $transaction->commit();
        } catch (\Throwable $e) {
            Yii::error($e, __METHOD__);
            $transaction->rollBack();
            throw $e;
        }
    }
}
