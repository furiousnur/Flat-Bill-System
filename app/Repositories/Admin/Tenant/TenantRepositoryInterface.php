<?php

namespace App\Repositories\Admin\Tenant;

interface TenantRepositoryInterface
{
    public function getAll(int $perPage = 10);
    public function findById(int $id);
    public function create(array $data);
    public function update($tenant, array $data);
    public function delete($tenant);
}
