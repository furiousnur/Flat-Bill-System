<?php

namespace App\Services\Admin;

use App\Repositories\Admin\HouseOwnerRepositoryInterface;

class HouseOwnerService implements HouseOwnerServiceInterface
{
    protected $repository;

    public function __construct(HouseOwnerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function listAllHouseOwners()
    {
        return $this->repository->getAll();
    }

    public function createHouseOwner(array $data)
    {
        $data['created_by'] = auth()->id();
        return $this->repository->create($data);
    }

    public function updateHouseOwner($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteHouseOwner($id)
    {
        return $this->repository->delete($id);
    }
}
