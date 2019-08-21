<?php
namespace App\Console\Controller;

use yii\console\Controller as BaseController;
use yii\helpers\VarDumper;
use yii\log\Logger;
use Yii;

class Controller extends BaseController
{
    /**
     * Logs and prints message to STDOUT.
     *
     * @param string  $message
     * @param string $category
     * @param int    $level
     */
    protected function logAndPrint(string $message, string $category = 'application', int $level = Logger::LEVEL_INFO): void
    {
        Yii::getLogger()->log($message, $level, $category);
        $this->stdout($message . PHP_EOL);
    }
}
