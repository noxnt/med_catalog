<?php


namespace App\Services\Substance;

use App\Models\Substance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            $substance = Substance::create($data);
            $this->loggingSuccess($substance, 'creating');
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            $this->loggingFailed($exception, 'create');
            return $exception->getMessage();
        }
    }

    public function update($substance, $data)
    {
        try {
            Db::beginTransaction();
            $substance->update($data);
            $this->loggingSuccess($substance, 'updating');
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            $this->loggingFailed($exception, 'update');
            return $exception->getMessage();
        }
        return $substance->fresh();
    }

    public function destroy($substance)
    {
        try {
            Db::beginTransaction();
            $substance->delete();
            $this->loggingSuccess($substance, 'deletion');
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            $this->loggingFailed($exception, 'delete');
            return $exception->getMessage();
        }
    }

    // Logs
    public function loggingSuccess($substance, $action) {
        Log::channel('debuginfo')->info("Successful $action - substance", [
            'id' => $substance->id,
            'name' => $substance->name,
        ]);
    }

    public function loggingFailed($exception, $action) {
        Log::channel('debuginfo')->error("Failed to $action - substance", [
            'error' => $exception->getMessage(),
        ]);
    }
}
