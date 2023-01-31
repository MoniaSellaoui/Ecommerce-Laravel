<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //afficher
    public function index()
    {$produits=Product::all();
        $categories=Category::all();
        return view('admin.produits.index')->with('produits',$produits)->with('categories',$categories);
    }


//ajouter
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
           'description'=>'required',
           'price'=>'required',
           'qte'=>'required',
           'photo'=>'required',
       ]);

        $produits=new Product();
      
    $produits->name=$request->name;
    $produits->category_id=$request->categorie;
    $produits->description=$request->description;
    $produits->price=$request->price;
    $produits->qte=$request->qte; 


    //image
   $newname=uniqid();
    $image=$request->file('photo');
    $newname.= ".". $image->getClientOriginalExtension();
    $destinationPath='uploads';
    
   $image->move($destinationPath,$newname);


    $produits->photo=$newname;  
 

    if($produits->save()) 
    {return redirect()->back();}
    else{echo "error";}  
    
}
//supprimer
  public function destroy($id)
  {
    $produit=Product::find($id);
    $file_path=public_path().'/uploads/'.$produit->photo;
   //dd($file_path) ;
   unlink($file_path);
  if($produit->delete()) 
  {
    return redirect()->back();
  } 
  else
  {echo "error";}
}
//modifier

public function update(Request $request)
{
  
//   $request->validate([
//     'name'=>'required',
//    'description'=>'required',
//    'price'=>'required',
//    'qte'=>'required',
//    'photo'=>'required',
// ]);



$produit=Product::find($request->idproduit);
//dd($produit);
 $produit->name=$request->name;
 $produit->description=$request->description;
 $produit->price=$request->price;
$produit->qte=$request->qte; 

if($request->file('photo')){
   //supprimer ancienne photo
    $file_path=public_path().'/uploads/'.$produit->photo;
   //dd($file_path) ;
   unlink($file_path);
   //upload nv photo
   $newname=uniqid();
   $image=$request->file('photo');
    $newname.= ".". $image->getClientOriginalExtension();
    $destinationPath='uploads';
   
   $image->move($destinationPath,$newname);


    $produit->photo=$newname; 

}
 


 if($produit->update()) 
 {return redirect()->back();}
 else{echo "error";}


}

public function search(Request $request)
{//dd($request);
   
   
   if($request->product_name && !$request->qte)
   { $produits=Product::where('name','LIKE', '%'.$request->product_name .'%' )->get();}

   if(!$request->product_name && $request->qte)
   { $produits=Product::where('qte','>=', $request->qte )->get();}

   if($request->product_name && $request->qte)
   { $produits=Product::where('name','LIKE', '%'.$request->product_name .'%' )
                        ->where('qte','>=', $request->qte )->get();}
   if(!$request->product_name && !$request->qte)
   {$produits=Product::all();}
    $categories=Category::all();
   return view('Admin.produits.index')->with('produits',$produits)->with('categories',$categories);
}



}
