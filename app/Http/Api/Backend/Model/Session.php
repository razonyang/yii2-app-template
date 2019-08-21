<?php
namespace App\Http\Api\Backend\Model;

use App\Model\Session as BaseSession;

class Session extends BaseSession
{
    public function fields()
    {
        return [
            'id',
            'ip_address',
            'user_agent',
            'expire_time',
            'create_time',
        ];
    }
}
