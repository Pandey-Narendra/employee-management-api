<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'address_line',
        'city',
        'state',
        'pincode'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
