<?php
namespace App\Http\Jwt;

use App\Domain\Contracts\Loginable;
use Firebase\JWT\JWT;

class TokenGenerator
{
    /** @var string */
    protected $key;
    
    /** @var string */
    protected $algorithm;
    
    public function __construct(string $key, string $algorithm = "HS256")
    {
        $this->key = $key;
        $this->algorithm = $algorithm;
    }

    /**
     * @param \App\Domain\Contracts\Loginable $user
     * @return string
     */
    public function generate(Loginable $user): string
    {
        return JWT::encode([
            'user' => [
                'id' => $user->getUserIdentifier(),
            ],
            'iat' => time(),
        ], $this->key, $this->algorithm);
    }
}
