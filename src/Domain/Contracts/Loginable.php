<?php
namespace App\Domain\Contracts;

interface Loginable
{
    /**
     * @return int
     */
    public function getUserIdentifier();
}
