<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallBack extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function branches()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
