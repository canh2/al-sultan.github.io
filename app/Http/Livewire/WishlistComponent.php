<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistComponent extends Component
{
    public function store($product_id,$product_name,$product_price)
    {
         Cart::instance('cart')->add($product_id,$product_name,$product_price,1)->associate('App\Models\Product');
         session()->flash('success_message','Item added to cart');
         return redirect()->route('shop.cart');
    }
    public function removeFromWishlist($product_id){
        foreach(Cart::instance('wishlist')->content() as $witem){
            if($witem->id==$product_id)
            {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-icon-component','refreshComponent');
                return;
            }
        }
       }
    public function render()
    {
        return view('livewire.wishlist-component');
    }
}
