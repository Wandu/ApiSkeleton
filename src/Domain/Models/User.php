<?php
namespace App\Domain\Models;

use App\Domain\Contracts\Loginable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Loginable
{
    /** @var array */
    protected $fillable = [
        'email',
        'password',
        'name',
    ];

    /**
     * {@inheritdoc}
     */
    public function getUserIdentifier()
    {
        return $this->getKey();
    }
}
