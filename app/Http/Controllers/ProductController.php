<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
     public function index(){
        $products=Product::with('category')->get();
        $user=Auth::user();  // Peut être null si pas connecté
        return view('products.index',compact('products','user'));
    }

    public function create(){
        $categories=Category::all();
        return view('products.create',compact('categories'));
    }

    public function store(Request $request){
        $validated=$request->validate([
            'category_id'=>'required|exists:categories,id',
             'name'=>'required|string|max:150',
             'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        
               'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);
        if($request->hasFile('image')){
            $validated['image']= $request->file('image')->store('product','public');
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('message','Produit ajouté avec succès');

    }

    public function show($id){
        $product=Product::with('category')->findOrFail($id);

        return view('products.show',compact('product'));
    }

    public function edit($id){
        $product=Product::findOrFail($id);
        $categories=Category::all();
         return view('products.edit', compact('product', 'categories'));
    }

  public function update(Request $request, $id){
    $product = Product::findOrFail($id);

    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:150',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
    ]);

    // Si l'utilisateur upload une nouvelle image
    if($request->hasFile('image')){
        $validated['image'] = $request->file('image')->store('product', 'public');
    }

    // Met à jour le produit avec les données validées
    $product->update($validated);

    return redirect()->route('products.index')->with('message','Produit mis à jour avec succès');
}


        public function delete($id){
            Product::findOrFail($id)->delete();
              return redirect()->route('products.index')->with('success', 'Produit supprimé');
                }
        

}
