<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\StoreBillPaymentRequest;
use App\Http\Requests\Owner\UpdateBillPaymentRequest;
use App\Repositories\Owner\Bill\BillRepositoryInterface;
use App\Repositories\Owner\Payment\PaymentRepositoryInterface;

class BillPaymentController extends Controller
{
    protected $repository;
    protected $billRepository;

    public function __construct(
        PaymentRepositoryInterface $repository,
        BillRepositoryInterface $billRepository
    ) {
        $this->repository = $repository;
        $this->billRepository = $billRepository;
    }

    /**
     * Display a listing of the payments.
     */
    public function index()
    {
        $payments = $this->repository->getAll(15);
        return view('owner.payments.list', compact('payments'));
    }

    /**
     * Show the form for creating a new payment.
     */
    public function create()
    {
        $bills = $this->billRepository->getAllWithoutPaginate(); // Only unpaid bills maybe
        return view('owner.payments.create', compact('bills'));
    }

    /**
     * Store a newly created payment in storage.
     */
    public function store(StoreBillPaymentRequest $request)
    {
        $data = $request->validated();
        try {
            $this->repository->create($request->all());

            return redirect()
                ->route('owner.bill-payments.index')
                ->with('success', 'Payment has been recorded successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing a payment.
     */
    public function edit($paymentId)
    {
        $payment = $this->repository->findById($paymentId);
        $bills = $this->billRepository->getAllWithoutPaginate();
        return view('owner.payments.edit', compact('payment', 'bills'));
    }

    /**
     * Update the specified payment in storage.
     */
    public function update(UpdateBillPaymentRequest $request, $paymentId)
    {
        $data = $request->validated();
        try {
            $this->repository->update($paymentId, $request->all());

            return redirect()
                ->route('owner.bill-payments.index')
                ->with('success', 'Payment has been updated successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified payment from storage.
     */
    public function destroy($paymentId)
    {
        try {
            $this->repository->delete($paymentId);

            return redirect()
                ->route('owner.bill-payments.index')
                ->with('success', 'Payment has been deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
