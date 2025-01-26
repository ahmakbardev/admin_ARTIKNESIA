<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterProvince extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cities(): HasMany
    {
        return $this->hasMany(MasterCity::class);
    }
}
