<?php

namespace App\Repositories\Owner\BillCategories;

interface BillCategoriesRepositoryInterface
{
    public function getAll(int $perPage = 10);
    public function findById(int $id);
    public function create(array $data);
    public function update($category, array $data);
    public function delete($category);
}
