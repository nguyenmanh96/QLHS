<?php

namespace App\Repositories\Repository;

use App\Models\RegisterSubject;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\RegisterSubjectRepositoryInterface;

class RegisterSubjectRepository extends BaseRepository implements RegisterSubjectRepositoryInterface
{
    public function __construct(RegisterSubject $registerSubject)
    {
        parent::__construct($registerSubject);
    }

}
