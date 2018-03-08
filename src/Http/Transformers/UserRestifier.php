<?php
namespace App\Http\Transformers;

use App\Domain\Models\User;

class UserRestifier
{
    public function __invoke(User $user)
    {
        return [
            'id' => $user->getKey(),
            'email' => $user->getAttribute("email"),
            'name' => $user->getAttribute("name"),
        ];
    }
}
