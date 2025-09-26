<?php

namespace App\Services\Admin;

interface HouseOwnerServiceInterface
{
    public function listAllHouseOwners();
    public function createHouseOwner(array $data);
    public function updateHouseOwner($id, array $data);
    public function deleteHouseOwner($id);
}
