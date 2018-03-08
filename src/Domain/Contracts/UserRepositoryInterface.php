<?php
namespace App\Domain\Contracts;

interface UserRepositoryInterface
{
    /**
     * @param int $id
     * @return \App\Domain\Contracts\Loginable
     * @throws \RuntimeException
     */
    public function find(int $id): Loginable;

    /**
     * @param string $email
     * @param string $password
     * @return \App\Domain\Contracts\Loginable
     * @throws \RuntimeException
     */
    public function findByEmailAndPassword(string $email, string $password): Loginable;

    /**
     * @param string $email
     * @param string $password
     * @param string $name
     * @return \App\Domain\Contracts\Loginable
     */
    public function register(string $email, string $password, string $name = null): Loginable;
}
