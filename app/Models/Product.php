<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Filterable;

    protected $table = 'products';
    protected $guarded = [];


    public function maker()
    {
        return $this->belongsTo(Maker::class);
    }

    public function substance()
    {
        return $this->belongsTo(Substance::class);
    }
}
