<?php
namespace Wandu\Api\Http\Controllers;

use Wandu\Api\Jwt\Jwt;
use Wandu\Api\Models\User;
use Wandu\Database\Manager;
use Wandu\Database\Query\SelectQuery;
use Wandu\Http\Contracts\ParsedBodyInterface;
use function Wandu\Http\Response\json;

class AuthController
{
    /** @var \Wandu\Database\Repository\Repository */
    protected $userRepos;
    
    /** @var \Wandu\Api\Jwt\Jwt */
    protected $jwt;
    
    public function __construct(Manager $manager, Jwt $jwt)
    {
        $this->userRepos = $manager->repository(User::class);
        $this->jwt = $jwt;
    }

    public function login(ParsedBodyInterface $parsedBody)
    {
        $username = $parsedBody->get('username');
        $password = $parsedBody->get('password');
        if (!$username || !$password) {
            return json([
                'success' => false,
                'message' => 'username, password required.',
            ], 400);
        }

        /** @var \Wandu\Api\Models\User $user */
        $user = $this->userRepos->first(function (SelectQuery $query) use ($username) {
            return $query->where('username', $username);
        });
        if (!$user || !$user->validPassword($password)) {
            return json([
                'success' => false,
                'message' => 'user not exists.',
            ], 400);
        }
        // will be transformer
        $token = $this->jwt->generate([
            'user' => [
                'id' => $user->getIdentifier(),
            ],
        ]);
        return [
            'success' => true,
            'token' => $token,
        ];
    }
}
