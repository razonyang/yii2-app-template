<?php
namespace App\Queue;

use Yii;

trait RetryableTrait
{
    /**
     * {@inheritdoc}
     */
    public function getTtr()
    {
        return 60;
    }

    /**
     * Gets maximum attempt times, default to 3.
     *
     * @return int maximum attempt times.
     */
    public function getMaxAttemptTimes(): int
    {
        return 3;
    }

    /**
     * {@inheritdoc}
     */
    public function canRetry($attempt, $error)
    {
        if ($error instanceof JobPreventedException) {
            Yii::warning(self::class . ' was prevented to execute', __METHOD__);
            return false;
        }

        return $attempt < $this->getMaxAttemptTimes();
    }
}
