<?php
namespace App\Http\Rest;

use Yii;
use yii\rest\OptionsAction as BaseOptionsAction;

class OptionsAction extends BaseOptionsAction
{
    /**
     * @var int $statusCode status code, default to 204(no content).
     */
    public $statusCode = 204;

    public function run($id = null)
    {
        Yii::$app->getResponse()->setStatusCode($this->statusCode);

        parent::run($id);
    }
}
