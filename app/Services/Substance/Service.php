<?php


namespace App\Services\Substance;

use App\Models\Substance;
use Illuminate\Support\Facades\DB;

class Service
{
    public function index($substances)
    {
        foreach ($substances as $substance) {
            $substance['product_count'] = $substance->products()->count();
        }

        return $substances;
    }

    public function store($data)
    {
        try {
            Db::beginTransaction();
            Substance::create($data);
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            return $exception->getMessage();
        }
    }

    public function update($substance, $data)
    {
        try {
            Db::beginTransaction();
            $substance->update($data);
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            return $exception->getMessage();
        }
        return $substance->fresh();
    }

    public function destroy($substance)
    {
        try {
            Db::beginTransaction();
            $substance->delete();
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            return $exception->getMessage();
        }
    }
}
