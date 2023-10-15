<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    //list

    public function list(){
        $category = category::when(request('key'),function($query){
            $query ->where('name','like','%'.request('key').'%')->get();
        })->orderBy('id','desc')->paginate(4);
        $category->appends(request()->all());
        return view('admin.category.list',compact('category'));
    }

    public function createPage(){

        return view('admin.category.create');
    }
    //create
    public function categoryCreate(Request $request){
       $this->validationCheck($request);
       $data = $this->createData($request);
       category::create($data);
       return redirect()->route('listPage');
    }

    //delete
    public function categoryDelete($id){
    category::where('id',$id)->delete();
    return back()->with(['deleteSuccess' => 'Successfully Delted ...']);
    }

    //editpage
    public function editPage($id){

       $edit = category::where('id',$id)->first();

        return view('admin.category.edit',compact('edit'));
    }

    public function categoryEdit(Request $request){

        $this->validationCheck($request);
        $updateCategory =  $this->createData($request);
        category::where('id',$request->categoryID)->update($updateCategory);

        return redirect()->route('listPage');

    }


    private function validationCheck($request){
        Validator::make($request->all(),[
          'categoryName' => 'required|unique:categories,name,'.$request->categoryID
        ],[
            'categoryName.required' => 'You need to fill'
        ])->validate();
    }
    private function createData($request){
        return [
            'name' => $request->categoryName
        ];

    }


}
