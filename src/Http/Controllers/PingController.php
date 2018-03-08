<?php
namespace App\Http\Controllers;

use App\Domain\Contracts\Loginable;

class PingController
{
    public function index(Loginable $user = null)
    {
        return [
            'success' => true,
            'message' => 'pong',
            'user' => $user,
        ];
    }
}
