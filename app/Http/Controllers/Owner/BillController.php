<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\StoreBillRequest;
use App\Http\Requests\Owner\UpdateBillRequest;
use App\Models\Bill;
use App\Repositories\Owner\Bill\BillRepositoryInterface;
use App\Repositories\Owner\BillCategories\BillCategoriesRepositoryInterface;
use App\Repositories\Owner\Flat\FlatRepositoryInterface;

class BillController extends Controller
{
    protected $repository;
    protected $billCategoryRepository;
    protected $flatRepository;

    public function __construct(
        BillRepositoryInterface $repository,
        BillCategoriesRepositoryInterface $billCategoryRepository,
        FlatRepositoryInterface $flatRepository
    ) {
        $this->repository = $repository;
        $this->billCategoryRepository = $billCategoryRepository;
        $this->flatRepository = $flatRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = $this->repository->getAll(15);
        return view('owner.bills.list', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $flats = $this->flatRepository->getAllWithoutPaginate();
        $billCategories = $this->billCategoryRepository->getAllWithoutPaginate();

        return view('owner.bills.create', compact('flats', 'billCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBillRequest $request)
    {
        $data = $request->validated();
        try {
            $houseOwner = auth()->user()->houseOwner;
            $data['house_owner_id'] = $houseOwner->id;
            $this->repository->create($data);

            return redirect()
                ->route('owner.bills.index')
                ->with('success', 'Bill has been created successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        $flats = $this->flatRepository->getAllWithoutPaginate();
        $billCategories = $this->billCategoryRepository->getAllWithoutPaginate();

        return view('owner.bills.edit', compact('bill', 'flats', 'billCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBillRequest $request, Bill $bill)
    {
        $this->repository->update($bill, $request->validated());
        return redirect()->route('owner.bills.index')
            ->with('success', 'Bill has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        $this->repository->delete($bill);

        return redirect()->route('owner.bills.index')
            ->with('success', 'Bill has been deleted successfully.');
    }
}
