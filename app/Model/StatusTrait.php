<?php
namespace App\Model;

trait StatusTrait
{
    public function isActive(): bool
    {
        return $this->status === StatusInterface::STATUS_ACTIVE;
    }

    public function isDisabled(): bool
    {
        return $this->status === StatusInterface::STATUS_DISABLED;
    }

    public function getStatusName(): string
    {
        switch ($this->status) {
            case StatusInterface::STATUS_ACTIVE:
                return \Yii::t('app', 'Active');
            case StatusInterface::STATUS_DISABLED:
                return \Yii::t('app', 'Disable');
            default:
                return \Yii::t('app', 'Unknown');
        }

        return 'Unknown';
    }
}
