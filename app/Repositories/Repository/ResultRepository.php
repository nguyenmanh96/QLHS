<?php

namespace App\Repositories\Repository;

use App\Models\Result;
use App\Repositories\BaseRepository;
use App\Repositories\Interface\ResultRepositoryInterface;

class ResultRepository extends BaseRepository implements ResultRepositoryInterface
{
    public function __construct(Result $result)
    {
        parent::__construct($result);
    }

}
