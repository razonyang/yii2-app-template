<?php
namespace App\Factory;

use App\Model\Ticket;
use Ramsey\Uuid\Uuid;

class TicketFactory
{
    public static function create(): Ticket
    {
        return new Ticket([
            'id' => Uuid::uuid4()->toString(),
        ]);
    }
}
