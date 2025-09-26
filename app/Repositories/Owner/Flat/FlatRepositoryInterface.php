<?php

namespace App\Repositories\Owner\Flat;

interface FlatRepositoryInterface
{
    public function getAll(int $perPage = 10);
    public function findById(int $id);
    public function create(array $data);
    public function update($flat, array $data);
    public function delete($flat);
}
