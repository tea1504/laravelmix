<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
