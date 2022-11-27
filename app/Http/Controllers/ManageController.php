<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\Product;

class ManageController extends Controller
{
    public function getProducts()
    {
        return ['products' => Product::all()];
    }

    public function createProduct()
    {
        $product = Product::create(request()->only(['name', 'price', 'sellable']));

        return ['product' => $product];
    }
}