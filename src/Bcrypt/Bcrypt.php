<?php
namespace Wandu\Api\Bcrypt;

use RuntimeException;

/**
 * @ref https://github.com/illuminate/hashing/blob/master/BcryptHasher.php
 */
class Bcrypt
{
    /**
     * @param string $value
     * @param null $cost
     * @return bool|string
     */
    public function hash(string $value, $cost = null): string
    {
        $hash = password_hash($value, PASSWORD_BCRYPT, [
            'cost' => $cost ?: 10,
        ]);
        if ($hash === false) {
            throw new RuntimeException('bcrypt hashing not supported.');
        }
        return $hash;
    }

    /**
     * @param  string  $value
     * @param  string  $hashedValue
     * @return bool
     */
    public function valid(string $value, string $hashedValue): bool
    {
        if (strlen($hashedValue) === 0) {
            return false;
        }
        return password_verify($value, $hashedValue);
    }
}
