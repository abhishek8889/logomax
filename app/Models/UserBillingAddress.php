<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBillingAddress extends Model
{
    use HasFactory;
    protected $table = 'user_billing_addresses';

    protected $fillable =[
        'first_name',
        'last_name',
        'organization',
        'address_1',
        'address_2',
        'zip_code',
        'city',
        'state',
        'tax_id',
        'country',
    ];
}
