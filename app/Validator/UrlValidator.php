<?php
namespace App\Validator;

use Yii;
use yii\validators\Validator;

class UrlValidator extends Validator
{
    public $schemes = ['http', 'https'];

    public function init()
    {
        parent::init();

        if ($this->message === null) {
            $this->message = Yii::t('yii', '{attribute} is not a valid URL.');
        }
    }
    
    protected function validateValue($value)
    {
        $url = parse_url($value);

        if (!isset($url['scheme'], $url['host']) || !in_array($url['scheme'], $this->schemes)) {
            return [$this->message, []];
        }

        return null;
    }
}
