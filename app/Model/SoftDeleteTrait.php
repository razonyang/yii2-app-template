<?php
namespace App\Model;

trait SoftDeleteTrait
{
    protected $softDeleteField = 'is_deleted';

    protected $softDeleteValue = 1;

    public function softDelete()
    {
        return $this->updateAttributes([
            $this->softDeleteField => $this->softDeleteValue,
        ]);
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        $field = $this->softDeleteField;
        return $this->$field == $this->softDeleteValue;
    }
}
