<?php
namespace App\Http\Form;

use App\Form\Form;
use RazonYang\Yii2\Uploader\UploadModelTrait;
use Yii;

/**
 * UploadForm
 */
class UploadForm extends Form
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
