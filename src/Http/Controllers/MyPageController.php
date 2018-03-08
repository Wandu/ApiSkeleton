<?php
namespace App\Http\Controllers;

use App\Domain\Contracts\Loginable;

class MyPageController
{
    public function index(Loginable $user)
    {
        return [
            'success' => true,
            'message' => "mypage",
            'user' => $user,
        ];
    }
}
