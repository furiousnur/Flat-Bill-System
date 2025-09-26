<?php

namespace App\Repositories\Owner\Building;

use App\Models\Building;
use Exception;

class BuildingRepository implements BuildingRepositoryInterface
{
    public function getAllWithoutPaginate()
    {
        return Building::orderBy('created_at', 'desc')->get();
    }

    public function getAll(int $perPage = 10)
    {
        return Building::orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findById(int $id)
    {
        return Building::with('user')->find($id);
    }

    public function create(array $data)
    {
        try {
            return Building::create($data);
        } catch (Exception $e) {
            throw new Exception("Failed to create Building: " . $e->getMessage());
        }
    }

    public function update($building, array $data)
    {
        try {
            return $building->update([
                'name' => $data['name'],
                'address' => $data['address'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception("Failed to update Building: " . $e->getMessage());
        }
    }

    public function delete($building)
    {
        try {
            $building->delete();
            return true;
        } catch (\Exception $e) {
            throw new \Exception("Failed to delete Building: " . $e->getMessage());
        }
    }
}
