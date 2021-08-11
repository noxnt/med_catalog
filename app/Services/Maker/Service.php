<?php


namespace App\Services\Maker;

use App\Models\Maker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            $maker = Maker::create($data);
            $this->loggingSuccess($maker, 'creating');
            Db::commit();

        } catch (\Exception $exception) {
            Db::rollBack();
            $this->loggingFailed($exception, 'create');
            return $exception->getMessage();
        }
    }

    public function update($maker, $data)
    {
        try {
            Db::beginTransaction();
            $maker->update($data);
            $this->loggingSuccess($maker, 'updating');
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            $this->loggingFailed($exception, 'update');
            return $exception->getMessage();
        }
        return $maker->fresh();
    }

    public function destroy($maker)
    {
        try {
            Db::beginTransaction();
            $maker->delete();
            $this->loggingSuccess($maker, 'deletion');
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            $this->loggingFailed($exception, 'delete');
            return $exception->getMessage();
        }
    }

    // Logs
    public function loggingSuccess($maker, $action) {
        Log::channel('debuginfo')->info("Successful $action - maker", [
            'id' => $maker->id,
            'name' => $maker->name,
        ]);
    }

    public function loggingFailed($exception, $action) {
        Log::channel('debuginfo')->error("Failed to $action - maker", [
            'error' => $exception->getMessage(),
        ]);
    }
}
