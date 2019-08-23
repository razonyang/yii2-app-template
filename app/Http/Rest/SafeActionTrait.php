<?php
namespace App\Http\Rest;

use App\Helper\DbHelper;
use yii\db\ActiveRecord;
use yii\db\Connection;

/**
 * @property string $modelClass
 */
trait SafeActionTrait
{
    public $enableTransaction = true;

    public function run($id = null, callable $callback = null)
    {
        $run = $callback ?? [$this, 'parent::run'];
        $args = array_filter([$id]);
        
        if (!$this->enableTransaction) {
            return call_user_func_array($run, $args);
        }

        return DbHelper::transaction($run, $args, $this->getDb());
    }

    public function getDb(): Connection
    {
        /** @var ActiveRecord $modelClass */
        $modelClass = $this->modelClass;
        /** @var Connection $db */
        return $modelClass::getDb();
    }
}
