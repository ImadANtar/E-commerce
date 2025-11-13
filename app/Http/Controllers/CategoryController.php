<?php
                                        //1
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::all();
        return view('categories.index',compact('categories'));
    }

    public function create(){
        return view('categories.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|string|unique:categories,name|min:3|max:40'
        ]);

        Category::create([
            'name'=>$request->name,
        ]);
        return redirect()->route('categories.index')->with('message','vous avez ajouter une nouvell category avec succès!');
    }

    public function edit($id){
        $category=Category::find($id);
        return view('categories.edit',compact('category'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required|string|min:3|max:40'
        ]);

        Category::findOrFail($id)->update([
            'name'=>$request->name
        ]);

        return redirect()->route('categories.index')->with('message','"categorie modifier avec succeès"');
    }

    public function delete($id){
        Category::findOrFail($id)->delete();
        return redirect()->back()->with('message',"categorie supprimer avec succeès");
    }
}
 