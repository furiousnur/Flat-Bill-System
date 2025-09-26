<?php

namespace App\Repositories\Admin\Tenant;

use App\Models\Building;
use App\Models\Tenant;
use Exception;

class TenantRepository implements TenantRepositoryInterface
{
    public function getAll(int $perPage = 10)
    {
        return Tenant::orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findById(int $id)
    {
        return Tenant::with('user')->find($id);
    }

    public function create(array $data)
    {
        try {
            $building = Building::find($data['building_id']);
            $data['house_owner_id'] = $building->house_owner_id ?? null;

            return Tenant::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'contact' => $data['contact'],
                'building_id' => $data['building_id'],
                'flat_id' => $data['flat_id'],
                'house_owner_id' => $data['house_owner_id'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception("Failed to create Tenant: " . $e->getMessage());
        }
    }


    public function update($tenant, array $data)
    {
        try {
            $building = Building::find($data['building_id']);
            $data['house_owner_id'] = $building->house_owner_id ?? null;
            return $tenant->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'contact' => $data['contact'],
                'building_id' => $data['building_id'],
                'flat_id' => $data['flat_id'],
                'house_owner_id' => $data['house_owner_id'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception("Failed to update Tenant: " . $e->getMessage());
        }
    }

    public function delete($houseOwner)
    {
        try {
            if ($houseOwner->user) {
                $houseOwner->user->delete();
            }
            $houseOwner->delete();
            return true;
        } catch (\Exception $e) {
            throw new \Exception("Failed to delete House Owner: " . $e->getMessage());
        }
    }
}
