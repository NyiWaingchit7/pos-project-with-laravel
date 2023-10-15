<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\User;
use App\Models\Order;
use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //home
    public function home(){
        $data = product::get();
        $category = category::get();
        $cart = cart::where('user_id',Auth::user()->id)->get();
        $history =  Order::where('user_id',Auth::user()->id)->paginate(5);
        return view('user.product.proudctList',compact('data','category','cart','history'));
    }
    public function passwordPage(){
        return view('user.account.password');
    }
    public function passChange(Request $request){
        $this->validationPass($request);
        $adminId = Auth::user()->id;
        $data = User::select('password')->where('id',$adminId)->first();
        $dbpass = $data->password;
        if(Hash::check($request->oldPass,$dbpass)){
           $newPass =[
            'password' => Hash::make($request->newPass)
           ];

           User::where('id',$adminId)->update($newPass);
           return redirect()->route('user#home');
        }
        return back()->with(['passmatch' => 'Old Password does not match..!']);


    }

    public function category($id){
        $data = product::where('category_id',$id)->get();
        $category = category::get();
        $cart = cart::where('user_id',Auth::user()->id)->get();
        $history =  Order::where('user_id',Auth::user()->id)->get();
        return view('user.product.proudctList',compact('data','category','cart','history'));
    }

    //detail
    public function detail($id){
        $detail = product::where('id',$id)->first();
        $pizza = product::get();
        return view('user.product.productDetail',compact('detail','pizza'));
    }
//history
public function history(){
   $history =  Order::where('user_id',Auth::user()->id)->paginate(5);

    return view('user.cart.history',compact('history'));
}

    private function validationPass($request){
        Validator::make($request->all(),[
            'oldPass'=>'required|min:6|max:12',
            'newPass'=>'required|min:6|max:12',
            'confirmPass'=>'required|min:6|max:12|same:newPass'

        ])->validate();
    }
}
