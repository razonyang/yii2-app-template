<?php
namespace App\Console\Job;

use App\Queue\Job;
use Yii;

class HelloJob extends Job
{
    public $name;

    protected function run()
    {
        $message = 'Hello ' . $this->name;
        echo $message . PHP_EOL;
        Yii::info($message, __METHOD__);
    }
}
