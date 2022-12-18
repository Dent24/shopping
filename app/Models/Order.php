<?php

namespace App\Models;

use App\Models\Detail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $fillable = ['send'];

    protected $casts = [
        'send' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'details')->withPivot('quantity');
    }

    public function details()
    {
        return $this->hasMany(Detail::class, 'order_id');
    }
}
