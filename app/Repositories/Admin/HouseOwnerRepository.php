<?php

namespace App\Repositories\Admin;

use App\Models\HouseOwner;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

class HouseOwnerRepository implements HouseOwnerRepositoryInterface
{
    public function getAllWithoutPaginate()
    {
        return HouseOwner::orderBy('created_at', 'desc')->get();
    }

    public function getAll(int $perPage = 10)
    {
        return HouseOwner::orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findById(int $id)
    {
        return HouseOwner::with('user')->find($id);
    }

    public function create(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'contact' => $data['contact'],
                    'password' => Hash::make($data['password']),
                ]);

                $user->assignRole('house-owner');

                $data['user_id'] = $user->id;

                return HouseOwner::create($data);
            });
        } catch (Exception $e) {
            throw new Exception("Failed to create House Owner: " . $e->getMessage());
        }
    }

    public function update($houseOwner, array $data)
    {
        try {
            return DB::transaction(function () use ($houseOwner, $data) {
                $user = $houseOwner->user;
                $user->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'contact' => $data['contact'],
                    'password' => !empty($data['password']) ? Hash::make($data['password']) : $user->password,
                ]);

                return $houseOwner->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'contact' => $data['contact'],
                ]);
            });
        } catch (\Exception $e) {
            throw new \Exception("Failed to update House Owner: " . $e->getMessage());
        }
    }

    public function delete($houseOwner)
    {
        try {
            if ($houseOwner->user) {
                $houseOwner->user->delete();
            }
            $houseOwner->delete();
            return true;
        } catch (\Exception $e) {
            throw new \Exception("Failed to delete House Owner: " . $e->getMessage());
        }
    }
}
