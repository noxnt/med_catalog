<?php


namespace App\Services\Maker;

use App\Models\Maker;
use Illuminate\Support\Facades\DB;

class Service
{
    public function index($makers)
    {
        foreach ($makers as $maker) {
            $maker['product_count'] = $maker->products()->count();
        }

        return $makers;
    }

    public function store($data)
    {
        try {
            Db::beginTransaction();
            Maker::create($data);
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            return $exception->getMessage();
        }
    }

    public function update($maker, $data)
    {
        try {
            Db::beginTransaction();
            $maker->update($data);
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            return $exception->getMessage();
        }
        return $maker->fresh();
    }

    public function destroy($maker)
    {
        try {
            Db::beginTransaction();
            $maker->delete();
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            return $exception->getMessage();
        }
    }
}
