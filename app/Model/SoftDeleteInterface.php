<?php
namespace App\Model;

interface SoftDeleteInterface
{
    /**
     * @return int|false
     */
    public function softDelete();

    /**
     * @return bool
     */
    public function isDeleted(): bool;
}
