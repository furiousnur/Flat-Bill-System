<?php

namespace App\Repositories\Admin;

interface HouseOwnerRepositoryInterface
{
    public function getAll(int $perPage = 10);
    public function findById(int $id);
    public function create(array $data);
    public function update($houseOwner, array $data);
    public function delete($houseOwner);
}
