<?php
namespace App\Http\Jwt;

use App\Domain\Contracts\Loginable;
use Firebase\JWT\JWT;

class TokenVerifier
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
     * @param string $jwtString
     * @return array
     */
    public function verify(string $jwtString): array
    {
        $decoded = JWT::decode($jwtString, $this->key, [$this->algorithm]);
        return (array)($decoded->user);
    }
}
