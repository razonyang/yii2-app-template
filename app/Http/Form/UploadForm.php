<?php
namespace App\Http\Form;

use App\Form\BaseForm;
use RazonYang\Yii2\Uploader\UploadModelTrait;
use Yii;

/**
 * UploadForm
 */
class UploadForm extends BaseForm
{
    use UploadModelTrait;
    
    protected function handleInternal()
    {
        $url = $this->upload();
        return [
            'url' => $url,
        ];
    }
}
