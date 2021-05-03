<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function dishes()
    {
        return $this->belongsToMany(Dish::class)
            ->withPivot('numerical_order', 'amount', 'price', 'status')
            ->withTimestamps();
    }
}
