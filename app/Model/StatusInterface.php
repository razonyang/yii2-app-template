<?php
namespace App\Model;

interface StatusInterface
{
    public const STATUS_INACTIVE = 0;

    public const STATUS_ACTIVE = 1;

    public function isActive(): bool;

    public function isDisabled(): bool;

    public function getStatusName(): string;
}
