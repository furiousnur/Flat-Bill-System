<?php

namespace App\Repositories\Owner\Bill;

use App\Mail\BillNotificationMail;
use App\Models\Bill;
use Exception;
use Illuminate\Support\Facades\Mail;

class BillRepository implements BillRepositoryInterface
{
    public function getAllWithoutPaginate()
    {
        return Bill::orderBy('created_at', 'desc')->get();
    }

    public function getAll(int $perPage = 10)
    {
        return Bill::orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findById(int $id)
    {
        return Bill::with(['flat', 'billCategory', 'houseOwner'])->find($id);
    }

    public function create(array $data)
    {
        try {
            if (isset($data['amount'])) {
                $data['due_amount'] = $data['amount'];
            }
            $bill = Bill::create($data);
            if ($bill->flat && $bill->flat->houseOwner && $bill->flat->houseOwner->email) {
                Mail::to($bill->flat->houseOwner->email)->send(new BillNotificationMail($bill, 'created'));
            }

            return $bill;
        } catch (\Exception $e) {
            throw new \Exception("Failed to create Bill: " . $e->getMessage());
        }
    }


    public function update($bill, array $data)
    {
        try {
            if (!($bill instanceof Bill)) {
                $bill = Bill::findOrFail($bill);
            }

            return $bill->update([
                'flat_id'           => $data['flat_id'],
                'bill_category_id'  => $data['bill_category_id'],
                'month'             => $data['month'],
                'amount'            => $data['amount'],
                'due_amount'            => $data['amount'],
                'notes'              => $data['notes'] ?? null,
            ]);
        } catch (Exception $e) {
            throw new Exception("Failed to update Bill: " . $e->getMessage());
        }
    }

    public function delete($bill)
    {
        try {
            if (!($bill instanceof Bill)) {
                $bill = Bill::findOrFail($bill);
            }

            $bill->delete();
            return true;
        } catch (Exception $e) {
            throw new Exception("Failed to delete Bill: " . $e->getMessage());
        }
    }
}
