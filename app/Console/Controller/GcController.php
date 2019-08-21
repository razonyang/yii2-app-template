<?php
namespace App\Console\Controller;

use App\Model\Session;
use Yii;

class GcController extends Controller
{
    public function actionSession()
    {
        $now = time();
        $deleted = Session::deleteAll([
            'AND',
            ['<', 'expire_time', $now],
            ['<', 'refresh_token_expire_time', $now]
        ]);
        $this->logAndPrint(sprintf('Deleted %d expired user sessions', $deleted));
    }
}
