<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\Product;

class ManageController extends Controller
{
    public function createProduct()
    {
        $product = Product::create(request()->only(['name', 'price', 'sellable']));

        return ['product' => $product];
    }
}