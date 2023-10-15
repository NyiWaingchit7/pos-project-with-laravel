<?php

namespace App\Http\Controllers;
use Storage;
use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //list Page
    public function list(){
        $product =  product::when(request('key'),function($query){$query ->where('products.name','like','%'.request('key').'%')->get();})
            ->select('products.*','categories.name as category_name')
            ->leftJoin('categories','products.category_id','categories.id')
            ->paginate(3);

        $product->appends(request()->all());
        return view('admin.product.list',compact('product'));
    }

    //add page
    public function addList(){
        $category = category::select('id','name')->get();
        return view('admin.product.addList',compact('category'));
    }
    //create
    public function createList(Request $request ){

        $this->validation($request,'create');
        $data = $this->data($request);
        $filename =  uniqid() . $request->file('pizzaImage')->GetClientOriginalName();
        $request->file('pizzaImage')->storeAs('public/',$filename);
        $data['image'] = $filename;
        product::create($data);
        return redirect()->route('product#list');
    }
    //delete
    public function delete($id){
        product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['delete'=>'Deleted Success']);
    }
    //view page
    public function view($id){
        $view = product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)
        ->first();

       return view('admin.product.view',compact('view'));
    }

    //edit Page
    public function editPage($id){
       $edit = product::where('id',$id)->first();
       $category = category::get();

        return view('admin.product.edit',compact('edit','category'));
    }
    //update
    public function update(Request $request){
        $this->validation($request,'update');
        $update = $this->data($request);
        if($request->hasFile('pizzaImage')){
            $oldpic =product::where('id',$request->pizzaId)->first();
            $oldpic = $oldpic->image;
            Storage::delete('public/'.$oldpic);
            $img =uniqid(). $request->file('pizzaImage')->GetClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$img);
            $update['image'] = $img;
        }
        product::where('id',$request->pizzaId)->update($update);
        return redirect()->route('product#list');

    }
    //viewCount
    public function viewCount(Request $request){

        $p = product::where('id',$request->id)->first();
        $viewcount = [
            'view_count' => $p->view_count + 1
        ];
       product::where('id',$request->id)->update($viewcount);
       return response()->json([
        'message' => 'success'
       ], 200, );
    }

    private function validation($request,$action){
        $rule = [
            'pizzaName' => 'required|unique:products,name,'.$request->pizzaId,
            'pizzaDescription' => 'required',
            'pizzaCategory' => 'required',
            'pizzaPrice' => 'required',


        ];
        $rule['pizzaImage'] = $action == 'create'?  'required|mimes:png,jpg,jpeg,file' :  'mimes:png,jpg,jpeg,file';
        Validator::make($request->all(),$rule)->validate();
    }

    private function data($request){

       return [
        'name' => $request->pizzaName,
        'description' => $request->pizzaDescription,
        'category_id' => $request->pizzaCategory,
        'price' => $request->pizzaPrice,

       ];

    }
}
