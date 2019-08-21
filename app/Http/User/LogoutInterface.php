<?php
namespace App\Http\User;

interface LogoutInterface
{
    /**
     * Logouts.
     *
     * @return bool
     */
    public function logout(): bool;
}
