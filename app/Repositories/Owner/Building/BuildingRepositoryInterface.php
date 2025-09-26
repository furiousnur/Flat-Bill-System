<?php

namespace App\Repositories\Owner\Building;

interface BuildingRepositoryInterface
{
    public function getAllWithoutPaginate();
    public function getAll(int $perPage = 10);
    public function findById(int $id);
    public function create(array $data);
    public function update($building, array $data);
    public function delete($building);
}
