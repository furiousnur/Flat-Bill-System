<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\StoreFlatRequest;
use App\Http\Requests\Owner\UpdateFlatRequest;
use App\Models\Flat;
use App\Repositories\Owner\Building\BuildingRepositoryInterface;
use App\Repositories\Owner\Flat\FlatRepositoryInterface;

class FlatController extends Controller
{
    protected $repository;
    protected $buildingRepository;

    public function __construct(FlatRepositoryInterface $repository, BuildingRepositoryInterface $buildingRepository)
    {
        $this->repository = $repository;
        $this->buildingRepository = $buildingRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flats = $this->repository->getAll(15);
        return view('owner.flats.list', compact('flats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buildings = $this->buildingRepository->getAllWithoutPaginate();
        return view('owner.flats.create', compact('buildings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFlatRequest $request)
    {
        $data = $request->validated();
        try {
            $houseOwner = auth()->user()->houseOwner;
            $data['house_owner_id'] = $houseOwner->id;
            $this->repository->create($data);
            return redirect()
                ->route('owner.flats.index')
                ->with('success', 'Flat has been created successfully.');
        } catch (\Exception $e) {
            dd($e);
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
    public function edit(Flat $flat)
    {
        $buildings = $this->buildingRepository->getAllWithoutPaginate();
        return view('owner.flats.edit', compact('flat', 'buildings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFlatRequest $request, Flat $flat)
    {
        $this->repository->update($flat, $request->validated());
        return redirect()->route('owner.flats.index')
            ->with('success', 'Flat has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flat $flat)
    {
        $this->repository->delete($flat);
        return redirect()->route('owner.flats.index')
            ->with('success', 'Flat has been deleted!');
    }
}
