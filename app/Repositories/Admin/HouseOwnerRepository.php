<?php

namespace App\Repositories\Admin;

use App\Models\HouseOwner;

class HouseOwnerRepository implements HouseOwnerRepositoryInterface
{
    public function getAll()
    {
        return HouseOwner::all();
    }

    public function findById($id)
    {
        return HouseOwner::findOrFail($id);
    }

    public function create(array $data)
    {
        return HouseOwner::create($data);
    }

    public function update($id, array $data)
    {
        $houseOwner = HouseOwner::findById($id);
        $houseOwner->update($data);
        return $houseOwner;
    }

    public function delete($id)
    {
        $houseOwner = HouseOwner::findById($id);
        return $houseOwner->delete();
    }
}
