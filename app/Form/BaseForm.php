<?php
namespace App\Form;

use yii\base\Model;

abstract class BaseForm extends Model implements Form
{
    use FormTrait;
    
    /**
     * @return mixed
     */
    abstract protected function handleInternal();
}
