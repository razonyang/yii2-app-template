<?php
namespace App\Console\Controller;

use App\Console\Job\HelloJob;
use Yii;

class HelloController extends Controller
{
    public function actionIndex($name = 'World')
    {
        $this->stdout('Hello ' . $name . PHP_EOL);
    }

    public function actionMail($to, $name = 'Foo')
    {
        $mailer = Yii::$app->getMailer();
        $sent = $mailer->compose('hello', ['name'  => $name])
            ->setTo($to)
            ->setFrom(Yii::$app->get('settingManager')->get('mailer.username'))
            ->setSubject('Hello')
            ->send();
        if (!$sent) {
            $this->stdout('Send failure' . PHP_EOL);
            return;
        }

        $this->stdout('Sent successfully' . PHP_EOL);
    }

    public function actionJob($name = 'World')
    {
        $job = new HelloJob(['name' => $name]);
        $id = Yii::$app->get('queue')->push($job);
        $this->stdout(HelloJob::class . '#' . $id . PHP_EOL);
    }
}
