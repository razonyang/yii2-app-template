<?php
namespace App\Http\Api\Backend\Controller;

use App\Http\Form\UploadForm;
use Yii;
use yii\web\UploadedFile;

class UploadController extends Controller
{
    public function actionImages()
    {
        $form = new UploadForm($this->getConfig('image'));
        $form->load(Yii::$app->getRequest()->post(), '');
        $form->file = UploadedFile::getInstanceByName('file');
        return $form->handle();
    }

    public function actionVideos()
    {
        $form = new UploadForm($this->getConfig('video'));
        $form->load(Yii::$app->getRequest()->post(), '');
        $form->file = UploadedFile::getInstanceByName('file');
        return $form->handle();
    }

    private function getConfig(string $type): array
    {
        /** @var \RazonYang\Yii2\Setting\ManagerInterface $setting */
        $setting = Yii::$app->get('settingManager');
        $prefix = 'upload.' . $type . '.';
        $parameters = ['maxSize', 'extensions'];
        $config = [];
        foreach ($parameters as $parameter) {
            $config[$parameter] = $setting->get($prefix.$parameter);
        }
        return $config;
    }
}
