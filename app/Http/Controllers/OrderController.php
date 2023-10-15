<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\orderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function list(){
       $order = Order::select('orders.*','users.name as user_name')
       ->leftJoin('users','users.id','orders.user_id')
       ->get();

        return view('admin.order.order',compact('order'));
    }
    public function status(Request $request){

        $order = Order::select('orders.*','users.name as user_name')->leftJoin('users','users.id','orders.user_id');

        if($request->dataStatus == null){
            $order = Order::get();
        }else{
            $order = Order:: where('orders.status',$request->dataStatus)->get();
        }
        return view('admin.order.order',compact('order'));
    }
    public function changeStatus(Request $request){
       $update = [
        'status' => $request->status
       ];
       Order::where('id',$request->pid)->update($update);
       return response()->json([
        'text' => 'update success'
       ], 200);
    }
    public function userList(){
        $userList = User::where('role','user')->get();
        return view('admin.userlist',compact('userList'));
    }
    public function userDelete(Request $request){
        User::where('id',$request->userId)->delete();
        return response()->json([
            'status' => 'success'
        ], 200);
    }
    public function changeRole(Request $request){
        $role = [
            'role' => $request->role
        ];
        User::where('id',$request->userId)->update($role);
        return response()->json([
            'status' => 'success'
        ], 200);
    }
    public function codeList(Request $request,$code){

       $orderdata = orderList::select('order_lists.*','products.name as product_name','products.price as product_price','products.image as product_image','users.name as user_name')
                    ->leftJoin('products','order_lists.product_id','products.id')
                    ->leftJoin('users','order_lists.user_id','users.id')
                    ->where('order_lists.order_code',$code)->get();

        return view('admin.orderlist',compact('orderdata'));
    }
}
