<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTenantRequest;
use App\Http\Requests\Admin\UpdateTenantRequest;
use App\Models\Tenant;
use App\Repositories\Admin\Tenant\TenantRepositoryInterface;
use App\Repositories\Owner\Building\BuildingRepositoryInterface;
use App\Repositories\Owner\Flat\FlatRepositoryInterface;

class TenantController extends Controller
{
    protected $repository;
    protected $flatRepository;
    protected $buildingRepository;

    public function __construct(
        TenantRepositoryInterface $repository,
        FlatRepositoryInterface $flatRepository,
        BuildingRepositoryInterface $buildingRepository,
    )
    {
        $this->repository = $repository;
        $this->flatRepository = $flatRepository;
        $this->buildingRepository = $buildingRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants = $this->repository->getAll(15);
        return view('admin.tenants.list', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $flats = $this->flatRepository->getAllWithoutPaginate();
        $buildings = $this->buildingRepository->getAllWithoutPaginate();
        return view('admin.tenants.create', compact('flats', 'buildings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTenantRequest $request)
    {
        $data = $request->validated();
        try {
            $this->repository->create($data);
            return redirect()
                ->route('admin.tenants.index')
                ->with('success', 'Tenant has been created successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        $flats = $this->flatRepository->getAllWithoutPaginate();
        $buildings = $this->buildingRepository->getAllWithoutPaginate();
        return view('admin.tenants.edit', compact('tenant', 'flats', 'buildings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTenantRequest $request, Tenant $tenant)
    {
        $this->repository->update($tenant, $request->validated());
        return redirect()->route('admin.tenants.index')
            ->with('success', 'Tenant has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        $this->repository->delete($tenant);
        return redirect()->route('admin.tenants.index')
            ->with('success', 'Tenant has been deleted successfully.');
    }
}
