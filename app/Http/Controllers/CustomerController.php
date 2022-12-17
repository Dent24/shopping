<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\Product;

class CustomerController extends Controller
{
    public function getProducts()
    {
        return ['products' => Product::where('sellable', true)->get()];
    }
}