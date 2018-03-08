<?php
namespace App\Http\Controllers;

use App\Domain\Contracts\UserRepositoryInterface;
use App\Domain\Models\User;
use App\Http\Jwt\TokenGenerator;
use App\Http\Transformers\UserRestifier;
use Wandu\Http\Contracts\ParsedBodyInterface;
use Wandu\Restifier\Restifier;

class AuthController
{
    /** @var \App\Domain\Contracts\UserRepositoryInterface */
    protected $userRepo;
    
    /** @var \App\Http\Jwt\TokenGenerator */
    protected $tokenGenerator;
    
    /** @var \Wandu\Restifier\Restifier */
    protected $restifier;
    
    public function __construct(UserRepositoryInterface $userRepo, TokenGenerator $tokenGenerator)
    {
        $this->userRepo = $userRepo;
        $this->tokenGenerator = $tokenGenerator;
        $this->restifier = new Restifier([
            User::class => new UserRestifier(),
        ]);
    }

    public function register(ParsedBodyInterface $params)
    {
        $user = $this->userRepo->register(
            $params->get('email'),
            $params->get('password')
        );
        return [
            'success' => true,
            'token' => $this->tokenGenerator->generate($user),
            'user' => $this->restifier->restify($user),
        ];
    }
    
    public function login(ParsedBodyInterface $params)
    {
        $user = $this->userRepo->findByEmailAndPassword(
            $params->get("email"),
            $params->get("password")
        );
        return [
            'success' => true,
            'token' => $this->tokenGenerator->generate($user),
            'user' => $this->restifier->restify($user),
        ];
    }
}
