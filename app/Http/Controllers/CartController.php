<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cartCreate(Request $request){
        logger($request);
        $data = $this->cartData($request);
        cart::create($data);
        $response = [
            'message' => 'Cart Creatae Successfully',
            'status' => 'success'
        ];
         return response()->json($response,200);

    }
    //edit
    public function edit(){
        $cart = cart::where('user_id',Auth::user()->id)
        ->select('carts.*','products.name as product_name','products.price as product_price')
        ->leftJoin('products','id','carts.product_id')
        ->get();
        $total=0;
        foreach($cart as $c){
            $total += $c->product_price * $c->quantity;
        }
        return view('user.cart.cartEdit',compact('cart','total'));
    }

    private function cartData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'quantity' => $request->qty
        ];
    }
}
