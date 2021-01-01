<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    protected $collection = 'listing';
    use SoftDeletes;
    protected $fillable = [
        'id',
        'product_name',
        'product_price',
        'person_name',
        'payment_method',
        'payment_amount',
        'date',
        'note',];
    protected $dates = ['deleted_at'];
}
