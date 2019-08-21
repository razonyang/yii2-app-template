<?php
namespace App\Validator;

use App\Model\Ticket;
use yii\validators\ExistValidator;

class TicketValidator extends ExistValidator
{
    public $targetClass = Ticket::class;

    public $targetAttribute = 'id';
}
