<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //
    public function contact(){
        return view('user.contact.contact');
    }
    public function message(Request $request){
       $this->validation($request);
       contact::create([
        'name' => Auth::user()->name,
        'email' => Auth::user()->email,
        'message' => $request->message
       ]);
      return redirect()->route('user#home');

    }

    public function show(){
        $message = contact::get();
        return view('admin.contactshow',compact('message'));
    }

    private function validation($request){
        Validator::make($request->all(),[
            'message' => 'required|min:10'
        ])->validate();
    }
}
