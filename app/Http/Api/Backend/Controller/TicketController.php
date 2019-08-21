<?php
namespace App\Http\Api\Backend\Controller;

use App\Model\Ticket;

class TicketController extends ActiveController
{
    public $modelClass = Ticket::class;

    public function actions()
    {
        $actions = parent::actions();

        return [
            'create' => $actions['create'],
            'options' => $actions['options'],
        ];
    }
}
