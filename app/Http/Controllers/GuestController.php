<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function home(){

        $produits=Product::all();
        $categories=Category::all();

        return view('guest.home')->with('produits',$produits)->with('categories',$categories);

    }
    public function productDetails($id)
    {   $product=Product::find($id);
        $products=Product::where('id','!=',$id)->get();
         $categories=Category::all();
      
        return view('guest.product-details')->with('categories',$categories)->with('product',$product)->with('products',$products);
    }

  
public function shop($idcategory)
{  $categories=Category::all();
    $category=Category::find($idcategory);
    $products=$category-> products;
    return view('guest.shop')->with('categories',$categories)->with('products',$products);
}

public function search(Request $request)

{//dd($request);
    $categories=Category::all();
    $products=Product::where('name','LIKE','%'. $request->keywords.'%')->get();
    return view('guest.shop')->with('categories',$categories)->with('products',$products);
    

}



}
