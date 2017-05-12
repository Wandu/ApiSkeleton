<?php
namespace Wandu\Api\Jwt;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class Jwt
{
    /** @var \Lcobucci\JWT\Signer\Hmac */
    protected $signer;
    
    public function __construct(Sha256 $signer)
    {
        $this->signer = $signer;
    }

    /**
     * @param array $attributes
     * @param string $sign
     * @return string
     */
    public function generate(array $attributes, string $sign = 'default'): string
    {
        $builder = new Builder();
        $builder->setIssuedAt(time());
        foreach ($attributes as $name => $value) {
            $builder->set($name, $value);
        }
        return $builder->sign($this->signer, $sign)->getToken()->__toString();
    }

    /**
     * @param string $hashed
     * @param string $sign
     * @return array
     */
    public function parse(string $hashed, string $sign = 'default')
    {
        $token = (new Parser())->parse($hashed);
        if ($token->verify($this->signer, $sign)) {
            return $token->getClaims();
        }
        return null;
    }
}
