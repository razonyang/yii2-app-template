<?php
namespace App\Queue;

use yii\base\Event;

class JobEvent extends Event
{
    /**
     * Event occurs before running job.
     */
    const BEFORE_RUN = 'job.beforeRun';

    /**
     * Event occurs after finishing job.
     */
    const AFTER_RUN = 'job.afterRun';

    /**
     * @var bool $isValid whether the job is valid, the job will be prevented to execute if
     * it is invalid.
     */
    public $isValid = true;

    /**
     * @var mixed $result job result.
     */
    public $result;
}
