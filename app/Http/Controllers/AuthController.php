<?php

namespace App\Http\Controllers;
use Storage;
use App\Models\User;
use App\Models\contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class AuthController extends Controller
{
    //
    public function loginPage(){
        return view('login');
    }
    public function registerPage(){
        return view('register');
    }

    public function dashboard(){
       if(Auth::user()->role =='admin'){
        return redirect()->route('listPage');
       }else{
        return redirect()->route('user#home');
       }
    }

    public function passChange(){
        return view('admin.changepassword');
    }

    public function changePass(Request $request){
        $this->validationPass($request);
        $adminId = Auth::user()->id;
        $data = User::select('password')->where('id',$adminId)->first();
        $dbpass = $data->password;
        if(Hash::check($request->oldPass,$dbpass)){
           $newPass =[
            'password' => Hash::make($request->newPass)
           ];

           User::where('id',$adminId)->update($newPass);
           return redirect()->route('listPage')->with(['passchange' => 'Password Changed Successfully...']);
        }
        return back()->with(['passmatch' => 'Old Password does not match..!']);


    }

    //detail Page
    public function detailPage(){
        return view('admin.accountDetail');
    }
    //edit page
    public function accountEdit(){
        return view('admin.edit');
    }

    //account update
    public function accountUpdate($id , Request $request){

        //for updatedata
        $this->updateValidationCheck($request);
        $updatedata = $this->updateData($request);

        //for image
        if($request->hasFile('image')){
            $dbpicname = User::where('id',$id)->first();
            $dbpicname = $dbpicname->image;
          if($dbpicname != null){
            Storage::delete('public/'.$dbpicname);
          }

          $updatepicname = uniqid() . $request->file('image')->GetClientOriginalName();
         $request->file('image')->storeAs('public',$updatepicname);
         $updatedata['image'] = $updatepicname;
        }
       User::where('id',$id)->update($updatedata);
       return redirect()->route('deatilPage');
    }
    //list
    public function list(){
        $data = User::where('role','admin')->paginate(3);

        return view('admin.adminList',compact('data'));
    }
    //delte
    public function delete($id){
        User::where('id',$id)->delete();
        return back();
    }
    //role change page
    public function changePage($id){
        $data = User::where('id',$id)->first();
        return view('admin.roleChange',compact('data'));
    }
    //role change
    public function changeRole($id, Request $request){
        $role = [
            'role' => $request->role
        ];
        User::where('id',$id)->update($role);
        return redirect()->route('admin#list');

    }
    //messagedelete
    public function messageDelete($id){
        contact::where('contact_id',$id)->delete();
        return back();
    }
    private function validationPass($request){
        Validator::make($request->all(),[
            'oldPass'=>'required|min:6|max:12',
            'newPass'=>'required|min:6|max:12',
            'confirmPass'=>'required|min:6|max:12|same:newPass'

        ])->validate();
    }

    private function updateValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' =>'required',
            'address' => 'required'

        ])->validate();
    }

    private function updateData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ];
    }
}
