<?php
namespace App\Http\Api\Form;

use Yii;
use yii\web\IdentityInterface;

trait UserTrait
{
    /**
     * @var IdentityInterface
     */
    private $user;

    public function getUser(): ?IdentityInterface
    {
        if ($this->user === null) {
            $this->user = Yii::$app->getUser()->getIdentity();
        }

        return $this->user;
    }

    public function setUser(IdentityInterface $user)
    {
        $this->user = $user;
    }
}
