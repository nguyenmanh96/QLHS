<?php

namespace App\Repositories\Repository;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\StudentRepositoryInterface;


class UserRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

}
