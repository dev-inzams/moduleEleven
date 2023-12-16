<?php

namespace App\Models;

use App\Models\customers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class invoices extends Model
{
    use HasFactory;

    public function customers(){
        return $this->belongsTo(customers::class);
    }
}
