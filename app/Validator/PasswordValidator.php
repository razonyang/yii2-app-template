<?php
namespace App\Validator;

use yii\validators\RegularExpressionValidator;

class PasswordValidator extends RegularExpressionValidator
{
    public $pattern = '/[\w]{6,}/';
}
