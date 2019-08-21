<?php
namespace App\Job;

use App\Queue\Job;
use App\Queue\RetryableTrait;
use yii\di\Instance;
use yii\mail\MailerInterface;
use yii\mail\MessageInterface;
use yii\queue\RetryableJob;

class MailJob extends Job implements RetryableJob
{
    use RetryableTrait;
    
    /**
     * @var string|array|MailerInterface $mailer
     */
    public $mailer = 'mailer';

    /**
     * @var array $messages
     */
    public $messages;

    public function init()
    {
        parent::init();

        $this->mailer = Instance::ensure($this->mailer, MailerInterface::class);
        foreach ($this->messages as &$message) {
            $message = Instance::ensure($message, MessageInterface::class);
        }
        unset($message);
    }

    protected function run()
    {
        $sent = $this->mailer->sendMultiple($this->messages);
        return $sent;
    }
}
