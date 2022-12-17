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

    public function updateOrCreateProduct()
    {
        $product = Product::updateOrCreate(['id' => request()->input('id')], request()->only(['name', 'price', 'sellable']));

        return ['product' => $product];
    }

    public function deleteProduct($product)
    {
        $product = Product::find($product);
        $deleted = $product->delete();

        return ['deleted' => $deleted];
    }
}