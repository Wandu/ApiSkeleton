<?php
namespace Wandu\Api\Models;

use Wandu\Api\Bcrypt\Bcrypt;
use Wandu\Database\Annotations\Column;
use Wandu\Database\Annotations\Table;

/**
 * @Table(name="users", increments=true)
 */
class User
{
    /**
     * @Column(name="id")
     * @var int
     */
    private $identifier;

    /**
     * @Column(name="username")
     * @var string
     */
    private $username;

    /**
     * @Column(name="password")
     * @var string
     */
    private $password;

    /**
     * @Column(name="permissions")
     * @var array
     */
    private $permissions;

    /**
     * @return int
     */
    public function getIdentifier(): int
    {
        return $this->identifier;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }
    
    public function validPassword($password): bool
    {
        return (new Bcrypt)->valid($password, $this->password);
    }
}
