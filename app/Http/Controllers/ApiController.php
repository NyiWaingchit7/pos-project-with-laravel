<?php

namespace App\Http\Controllers;

use App\Models\contact;
use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function getProductlist(){
        $data = product::get();
        return response()->json($data, 200);
    }
    public function getCategory(){
        $data = category::get();
        return response()->json($data, 200,);
    }

    //create product
    public function createProduct(Request $request){
        $data = $this.createlist();
        $response = product::create($data);
        return response()->json($response, 200);
    }
    public function createContact(Request $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
        $response = contact::create($data);
        return response()->json($response, 200);
    }

    private function createlist($request){
        $data = [
            'name' => $request->name
        ];
    }
    //delte data
    public function deleteContact(Request $request){
        $data = contact::where('id',$request->id)->first();
        if(isset($data)){
            contact::where('id',$request->id)->delete();
            return response()->json(['message'=>'deleteSuccess'], 200);
        }
        return response()->json(['message' => 'There is no data with this id'], 200);
    }
    public function getdeleteContact( $id){
        $data = contact::where('id',$id)->first();
        if(isset($data)){
            contact::where('id',$id)->delete();
            return response()->json(['message'=>'deleteSuccess'], 200);
        }
        return response()->json(['message' => 'There is no data with this id'], 200);
    }

    //view data
    public function viewproduct(Request $request){
        $data = product::where('id',$request->id)->first();
        if(isset($data)){
           $data =product::where('id',$request->id)->get();
            return response()->json($data, 200);
        }
        return response()->json(['message' => 'There is no data with this id'], 200);
    }
    public function getviewproduct( $id){
        $data = product::where('id',$id)->first();
        if(isset($data)){
            $data=product::where('id',$id)->delete();
            return response()->json($data, 200);
        }
        return response()->json(['message' => 'There is no data with this id'], 200);
    }

    //update data
    public function updatecategory(Request $request){
        $data = category::where('id',$request->id)->first();
        if(isset($data)){
            $update = [
                'name' => $request->categoryName
            ];
            category::where('id',$request->id)->update($update);
            return response()->json(['message'=>'updateSuccess'], 200);
        }
        return response()->json(['message' => 'there is no data with this id'], 200, $headers);
    }
}
