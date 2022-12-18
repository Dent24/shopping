<?php
 
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Models\Detail;
use App\Models\Order;
use App\Models\Product;

class CustomerController extends Controller
{
    public function getProducts()
    {
        $order = null;

        if (auth()->check()) {
            $order = auth()->user()->orders()->where('send', false)->with('details.product')->first();
        }

        return [
            'products' => Product::where('sellable', true)->get(),
            'order' => $order,
        ];
    }

    public function addCart(Product $product)
    {
        $order = auth()->user()->orders()->where('send', false)->first();

        if (! isset($order)) {
            $order = auth()->user()->orders()->create();
        }

        $detail = $order->details()->where('product_id', $product->id)->first();

        if (isset($detail)) {
            $detail->update(['quantity' => request()->input('quantity')]);
        } else {
            $detail = new Detail(['quantity' => request()->input('quantity')]);
            $detail->order()->associate($order);
            $detail->product()->associate($product);
            $detail->save();
        }

        return ['order' => auth()->user()->refresh()->orders()->where('send', false)->first()->load('details.product')];
    }

    public function removeDeatail(Detail $detail)
    {
        $detail->delete();
        return ['order' => auth()->user()->refresh()->orders()->where('send', false)->first()->load('details.product')];
    }

    public function sendOrder(Order $order)
    {
        return ['updated' => $order->update(['send' => true])];
    }

    public function deleteOrder(Order $order)
    {
        return ['deleted' => $order->delete()];
    }
}