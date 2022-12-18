<?php

namespace App\Models;

use App\Models\Detail;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = ['name', 'price', 'sellable'];

    protected $casts = [
        'price' => 'integer',
        'sellable' => 'boolean',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'details')->withPivot('quantity');
    }

    public function details()
    {
        return $this->hasMany(Detail::class, 'product_id');
    }
}
