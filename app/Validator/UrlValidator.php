<?php
namespace App\Validator;

use Yii;
use yii\validators\Validator;

class UrlValidator extends Validator
{
    public const COMPONENT_SCHEME = 'scheme';
    public const COMPONENT_HOST = 'host';
    public const COMPONENT_PORT = 'port';
    public const COMPONENT_USER = 'user';
    public const COMPONENT_PASS = 'pass';
    public const COMPONENT_PATH = 'path';
    public const COMPONENT_QUERY = 'query';
    public const COMPONENT_FRAGMENT = 'fragment';

    public $schemes = ['http', 'https'];

    public $components = [
        self::COMPONENT_SCHEME,
        self::COMPONENT_HOST,
    ];

    public function init()
    {
        parent::init();

        if ($this->message === null) {
            $this->message = Yii::t('yii', '{attribute} is not a valid URL.');
        }
    }
    
    protected function validateValue($value)
    {
        $components = parse_url($value);
        foreach ($this->components as $name) {
            if (!isset($components[$name])) {
                return [$this->message, []];
            }
        }

        if (!in_array($components[self::COMPONENT_SCHEME], $this->schemes)) {
            return [$this->message, []];
        }

        return null;
    }
}
