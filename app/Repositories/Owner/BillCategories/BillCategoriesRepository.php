<?php

namespace App\Repositories\Owner\BillCategories;

use App\Models\BillCategory;
use Exception;

class BillCategoriesRepository implements BillCategoriesRepositoryInterface
{
    public function getAllWithoutPaginate()
    {
        return BillCategory::forOwner()->orderBy('created_at', 'desc')->get();
    }

    public function getAll(int $perPage = 10)
    {
        return BillCategory::forOwner()->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findById(int $id)
    {
        return BillCategory::with('user')->forOwner()->find($id);
    }

    public function create(array $data)
    {
        try {
            return BillCategory::create($data);
        } catch (Exception $e) {
            throw new Exception("Failed to create Bill Category: " . $e->getMessage());
        }
    }

    public function update($category, array $data)
    {
        try {
            if (!($category instanceof \App\Models\BillCategory)) {
                $category = \App\Models\BillCategory::findOrFail($category);
            }
            return $category->update([
                'name'        => $data['name'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception("Failed to update Bill Category: " . $e->getMessage());
        }
    }

    public function delete($category)
    {
        try {
            $category->delete();
            return true;
        } catch (\Exception $e) {
            throw new \Exception("Failed to delete Bill Category: " . $e->getMessage());
        }
    }
}
