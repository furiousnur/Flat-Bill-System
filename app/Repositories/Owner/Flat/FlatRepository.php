<?php

namespace App\Repositories\Owner\Flat;

use App\Models\Flat;
use Exception;

class FlatRepository implements FlatRepositoryInterface
{
    public function getAllWithoutPaginate()
    {
        return Flat::forOwner()->orderBy('created_at', 'desc')->get();
    }

    public function getAll(int $perPage = 10)
    {
        return Flat::forOwner()->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findById(int $id)
    {
        return Flat::with('user')->forOwner()->find($id);
    }

    public function create(array $data)
    {
        try {
            return Flat::create($data);
        } catch (Exception $e) {
            throw new Exception("Failed to create Flat: " . $e->getMessage());
        }
    }

    public function update($flat, array $data)
    {
        try {
            if (!($flat instanceof \App\Models\Flat)) {
                $flat = \App\Models\Flat::findOrFail($flat);
            }
            return $flat->update([
                'building_id'        => $data['building_id'],
                'flat_number'        => $data['flat_number'],
                'flat_owner_name'    => $data['flat_owner_name'],
                'flat_owner_contact' => $data['flat_owner_contact'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception("Failed to update Flat: " . $e->getMessage());
        }
    }

    public function delete($flat)
    {
        try {
            $flat->delete();
            return true;
        } catch (\Exception $e) {
            throw new \Exception("Failed to delete Flat: " . $e->getMessage());
        }
    }
}
