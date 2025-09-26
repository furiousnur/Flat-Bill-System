<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateHouseOwnerRequest;
use App\Http\Requests\StoreHouseOwnerRequest;
use App\Models\HouseOwner;
use App\Repositories\Admin\HouseOwnerRepositoryInterface;
use Illuminate\Http\Request;

class HouseOwnerController extends Controller
{
    protected $repository;

    public function __construct(HouseOwnerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $owners = $this->repository->getAll(15);
        return view('admin.house-owner.list', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.house-owner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHouseOwnerRequest $request)
    {
        $data = $request->validated();

        try {
            $this->repository->create($data);

            return redirect()
                ->route('admin.house-owners.index')
                ->with('success', 'House Owner profile has been created successfully.');
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
    public function edit(HouseOwner $owner)
    {
        return view('admin.house-owner.edit', compact('owner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHouseOwnerRequest $request, HouseOwner $houseOwner)
    {
        $this->repository->update($houseOwner, $request->validated());

        return redirect()->route('admin.house-owners.index')
            ->with('success', 'House Owner profile has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HouseOwner $houseOwner)
    {
        $this->repository->delete($houseOwner);
        return redirect()->route('admin.house-owners.index')
            ->with('success', 'House Owner profile has been deleted!');
    }
}
