<?php

namespace App\Repositories\Repository;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\UserRepositoryInterface;


class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function findByGoogleToken($googleToken)
    {
        return $this->where('google_token', $googleToken)->first();
    }

    public function findByRememberToken($token)
    {
        return $this->where('remember_token', $token)->first();
    }

    public function findByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

}
