<?php

namespace App\Repositories\Eloquent;

abstract class AbstractRepository
{


    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    public function get()
    {
        return $this->model->get();
    }
    public function where(string $column, $value = null, $operator = '')
    {
        return $this->model->where($column, $operator, $value);
    }
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }
    public function update(array $data)
    {
        return $this->model->update($data);
    }
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }
    protected function resolveModel()
    {
        return app($this->model);
    }

}