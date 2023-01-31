<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()

    { $categories=Category::all();
        return view('Admin.categories.index')->with('categories',$categories);
    }
//save
    public function store(Request $request)
    {$request->validate([
        'name'=>'required',
        'description'=>'required',
    ]);
    $category=new Category;
    $category->name=$request->name;
    $category->description=$request->description;
   if($category->save()) 
   {return redirect()->back();}
   else{echo "error";}


    }
    
//delete
    public function destroy($id){
        $categorie=Category::find($id);
      if($categorie->delete()) 
      {
        return redirect()->back();
      } 
      else
      {echo "error";}
    }


//update
public function update(Request $request)
{


    $request->validate([
        'name'=>'required',
        'description'=>'required',
    ]);

    $id=$request->id_category;
    $categorie=Category::find($id);
    $categorie->name=$request->name;
    $categorie->description=$request->description;
   if($categorie->update()) 
   {return redirect()->back();}
   else{echo "error";}
    


    }


}
