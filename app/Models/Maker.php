<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maker extends Model
{
    use HasFactory;
    use Filterable;

    protected $table = 'makers';
    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
