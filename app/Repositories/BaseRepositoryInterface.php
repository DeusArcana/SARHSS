<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    public function all();

    public function find($id, $columns = ['*']);

    public function findBy($field, $value, $columns = ['*']);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);
}
