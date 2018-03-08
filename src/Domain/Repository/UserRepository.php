<?php
namespace App\Domain\Repository;

use App\Domain\Contracts\Loginable;
use App\Domain\Contracts\UserRepositoryInterface;
use App\Domain\Models\User;
use RuntimeException;

class UserRepository implements UserRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function find(int $id): Loginable
    {
        return User::query()->findOrFail($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findByEmailAndPassword(string $email, string $password): Loginable
    {
        $user = User::query()->where('email', $email)->first();
        if (password_verify($password, $user->getAttribute('password'))){
            return $user;
        }
        throw new RuntimeException("cannot found user.");
    }

    /**
     * {@inheritdoc}
     */
    public function register(string $email, string $password, string $name = null): Loginable
    {
        return User::query()->create([
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'name' => $name,
        ]);
    }
}
