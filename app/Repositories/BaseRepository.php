<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->query();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $record = $this->model->findOrFail($id);
        $record->update($attributes);
        return $record;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function where($col, $value)
    {
        return $this->model->where($col, $value);
    }

    public function exists($col, $value)
    {
        return $this->model->where($col, $value)->exists();
    }

    public function search($condition, $method, $conditions)
    {
        return $this->model->where($condition, $method, $conditions);
    }

}
