<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\StoreBuildingRequest;
use App\Http\Requests\Owner\UpdateBuildingRequest;
use App\Models\Building;
use App\Repositories\Owner\Building\BuildingRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller
{
    protected $repository;

    public function __construct(BuildingRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buildings = $this->repository->getAll(15);
        return view('owner.buildings.list', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('owner.buildings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBuildingRequest $request)
    {
        $data = $request->validated();
        try {
            $houseOwner = auth()->user()->houseOwner;
            $data['house_owner_id'] = $houseOwner->id;
            $this->repository->create($data);
            return redirect()
                ->route('owner.buildings.index')
                ->with('success', 'Building has been created successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Building $building)
    {
        return view('owner.buildings.edit', compact('building'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBuildingRequest $request, Building $building)
    {
        $this->repository->update($building, $request->validated());
        return redirect()->route('owner.buildings.index')
            ->with('success', 'Building has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Building $building)
    {
        $this->repository->delete($building);
        return redirect()->route('owner.buildings.index')
            ->with('success', 'Building has been deleted!');
    }
}
