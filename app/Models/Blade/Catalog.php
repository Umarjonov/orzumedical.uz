<?php

namespace App\Models\Blade;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function child(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Catalog::class,'parent_id','id')->where('is_active',1);
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class,'id','catalog_id')->where('is_active',1);
    }
}
