<?php

namespace App\Repositories\Contracts;

interface CustomerRepositoryInterface
{
    public function create(array $data);
    public function get();
    public function where(string $column, $value = null, $operator = '');
    public function findOrFail($id);
    public function update(array $data);
    public function destroy($id);
}