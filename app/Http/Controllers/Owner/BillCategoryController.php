<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\StoreBillCategoryRequest;
use App\Http\Requests\Owner\UpdateBillCategoryRequest;
use App\Models\BillCategory;
use App\Repositories\Owner\BillCategories\BillCategoriesRepositoryInterface;

class BillCategoryController extends Controller
{
    protected $repository;

    public function __construct(BillCategoriesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $billCategoeries = $this->repository->getAll(15);
        return view('owner.bill-categories.list', compact('billCategoeries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('owner.bill-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBillCategoryRequest $request)
    {
        $data = $request->validated();
        try {
            $houseOwner = auth()->user()->houseOwner;
            $data['house_owner_id'] = $houseOwner->id;
            $this->repository->create($data);
            return redirect()
                ->route('owner.bill-categories.index')
                ->with('success', 'Flat has been created successfully.');
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
    public function edit(BillCategory $billCategory)
    {
        dd($billCategory);
        return view('owner.bill-categories.edit', compact('billCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBillCategoryRequest $request, BillCategory $category)
    {
        $this->repository->update($category, $request->validated());
        return redirect()->route('owner.bill-categories.index')
            ->with('success', 'Bill Category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillCategory $billCategory)
    {
        $this->repository->delete($billCategory);
        return redirect()->route('owner.bill-categories.index')
            ->with('success', 'Bill Category has been deleted!');
    }
}
