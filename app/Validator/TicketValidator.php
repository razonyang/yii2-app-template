<?php
namespace App\Validator;

use yii\validators\ExistValidator;
use App\Model\Ticket;

class TicketValidator extends ExistValidator
{
    public $targetClass = Ticket::class;

    public $targetAttribute = 'id';
}
