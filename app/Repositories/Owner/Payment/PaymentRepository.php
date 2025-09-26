<?php

namespace App\Repositories\Owner\Payment;

use App\Mail\BillNotificationMail;
use App\Models\BillPayment;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PaymentRepository implements PaymentRepositoryInterface
{
    /**
     * Get all payments without pagination
     */
    public function getAllWithoutPaginate()
    {
        return BillPayment::with(['bill.flat.building.houseOwner', 'bill.billCategory'])
            ->forOwner()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get all payments with pagination
     */
    public function getAll(int $perPage = 10)
    {
        return BillPayment::with(['bill.flat.building.houseOwner', 'bill.billCategory'])
            ->forOwner()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Find payment by ID
     */
    public function findById(int $id)
    {
        return BillPayment::with(['bill.flat.building.houseOwner', 'bill.billCategory'])->forOwner()->find($id);
    }

    /**
     * Create a new payment
     */
    public function create(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                $payment = BillPayment::create([
                    'house_owner_id' => auth()->user()->houseOwner->id,
                    'bill_id'        => $data['bill_id'],
                    'amount'         => $data['amount'],
                    'payment_method' => $data['payment_method'],
                    'paid_at'        => $data['paid_at'] ?? now(),
                ]);
                $bill = $payment->bill;
                $bill->due_amount -= $payment->amount;

                if ($bill->due_amount <= 0) {
                    $bill->status = 'paid';
                    $bill->due_amount = 0;
                } else {
                    $bill->status = 'unpaid';
                }

                $bill->save();
                if ($bill->flat && $bill->flat->houseOwner && $bill->flat->houseOwner->email) {
                    Mail::to($bill->flat->houseOwner->email)->queue(new BillNotificationMail($bill, 'paid', $payment));
                }
                return $payment;
            });
        } catch (Exception $e) {
            dd($e);
            throw new Exception("Failed to create payment: " . $e->getMessage());
        }
    }

    /**
     * Update a payment
     */
    public function update($payment, array $data)
    {
        try {
            return DB::transaction(function () use ($payment, $data) {
                if (!($payment instanceof BillPayment)) {
                    $payment = BillPayment::forOwner()->findOrFail($payment);
                }
                $payment->update([
                    'bill_id'        => $data['bill_id'],
                    'amount'         => $data['amount'],
                    'payment_method' => $data['payment_method'],
                    'paid_at'        => $data['paid_at'] ?? $payment->paid_at,
                ]);

                $bill = $payment->bill;
                $totalPaid = $bill->payments()->sum('amount');

                if ($totalPaid >= $bill->amount) {
                    $bill->status = 'paid';
                    $bill->due_amount = 0;
                } else {
                    $bill->status = 'unpaid';
                    $bill->due_amount = $bill->amount - $totalPaid;
                }

                $bill->save();
                return $payment;
            });
        } catch (Exception $e) {
            dd($e);
            throw new Exception("Failed to update payment: " . $e->getMessage());
        }
    }

    /**
     * Delete a payment
     */
    public function delete($payment)
    {
        try {
            if (!($payment instanceof BillPayment)) {
                $payment = BillPayment::forOwner()->findOrFail($payment);
            }

            $bill = $payment->bill;
            $bill->due_amount += $payment->amount;
            $bill->status = 'unpaid';
            $bill->save();
            $payment->delete();
            return true;
        } catch (Exception $e) {
            throw new Exception("Failed to delete payment: " . $e->getMessage());
        }
    }
}
