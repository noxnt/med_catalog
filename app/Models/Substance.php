<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Substance extends Model
{
    use HasFactory;
    use Filterable;

    protected $table = 'substances';
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
