<?php
namespace App\Queue;

use yii\base\Component;
use yii\queue\JobInterface;
use yii\queue\Queue;

abstract class Job extends Component implements JobInterface
{
    /**
     * @var Queue $queue queue instace.
     */
    private $queue;

    /**
     * Gets queue instance
     *
     * @return Queue $queue queue instance.
     */
    protected function getQueue(): Queue
    {
        return $this->queue;
    }

    /**
     * {@inheritdoc}
     */
    public function execute($queue)
    {
        $this->queue = $queue;

        if (!$this->beforeRun()) {
            throw new JobPreventedException();
        }

        $result = $this->run();
        $this->afterRun($result);
    }

    /**
     * Invoke before running job.
     *
     * @return bool whether the job is valid.
     */
    protected function beforeRun(): bool
    {
        $event = new JobEvent();
        $this->trigger(JobEvent::BEFORE_RUN, $event);
        return $event->isValid;
    }

    /**
     * Invoke after finishing job.
     */
    protected function afterRun($result)
    {
        $event = new JobEvent([
            'result' => $result
        ]);
        $this->trigger(JobEvent::AFTER_RUN, $event);
    }

    /**
     * Run job.
     *
     * @return mixed job result.
     */
    abstract protected function run();
}
