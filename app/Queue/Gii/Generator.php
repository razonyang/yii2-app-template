<?php
namespace App\Queue\Gii;

use App\Queue\Job;
use App\Queue\RetryableTrait;
use yii\queue\gii\Generator as BaseGenerator;

class Generator extends BaseGenerator
{
    public $ns = 'App\Job';
    
    public $baseClass = Job::class;

    public $retryableTrait = RetryableTrait::class;
    
    public $templates = [
        'default' => '@resources/queue/gii/views',
    ];

    public $formView = '@resources/queue/gii/views/form.php';

    public function formView()
    {
        return $this->formView;
    }
}
