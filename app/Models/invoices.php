<?php

namespace App\Models;

use App\Models\customers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class invoices extends Model
{
    use HasFactory;
    protected $fillable = [
        'grandTotal',
        'customerName',
        'date',
        'dueDate',
        'subtotal',
        'discount',
        'reference',
        'tremsAndCondition',
        'number'

    ];

    public function customers(){
        return $this->belongsTo(customers::class);
    }
}
