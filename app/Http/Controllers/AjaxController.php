<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Order;
use App\Models\product;
use App\Models\orderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //
    public function sorting(Request $request){

        if($request->status == 'asc'){
            $data = product::orderBy('id','asc')->get();
        }else{
            $data = product::orderBy('id','desc')->get();
        }

        return $data;
    }
    public function order(Request $request){
        $total = 0;
     foreach($request->all() as $item){
         $data = orderList::create([
            'user_id' => $item['userId'],
            'product_id'=>$item['productId'],
            'qty' => $item['qty'],
            'order_code' =>$item['orderCode'],
            'total' => $item['total']
        ]);
        $total += $data->total ;
        logger($data);
     }

     cart::where('user_id',Auth::user()->id)->delete();
     Order::create([
        'user_id'=> Auth::user()->id,
        'order_code' => $data->order_code ,
        'total_price'=> $total + 5000
     ]);
     return  response()->json([
        'status' => 'success',
        'message' =>'order complete'
     ], 200);



    }
    public function clearCart(){
        cart::where('user_id',Auth::user()->id)->delete();
    }
    public function clear(Request $request){
    cart::where('cart_id',$request->cartId)->delete();
    }
}
