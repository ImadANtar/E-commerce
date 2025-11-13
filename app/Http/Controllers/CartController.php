<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $userId=Auth::id();
        $cartItems=CartItem::where('user_id',$userId)->with('product')->get();
        return view('cart.index',compact('cartItems'));

    }

    public function add(Request $request){
        $request->validate([
            'product_id'=>'required|exists:products,id',
            'quantité'=>'required|integer|min:1',
        ]);

        $userId=Auth::id();
        $productId=$request->product_id;
        $quantité=$request->quantité;

        //check  product if in in cart 

        $cartItem=CartItem::where('user_id',$userId)
                            ->where('product_id',$productId)
                            ->first();

        if($cartItem){
            //update the quantuty
            $cartItem->quantité+=$quantité;
            $cartItem->save();

        } else{
            //add new item to cart
            CartItem::create([
                'user_id'=>$userId,
                'product_id'=>$productId,
                'quantité'=>$quantité,
            ]);
              }

              return redirect()->route('cart.index')->with('message','produit ajouté au panier avec success');
 

    }
          // Modifier la quantité d'un produit dans le panier
            public function update(Request $request,$id){
                 $request->validate([
                        'quantité'=>'required|integer|min:1',

                 ]);
                    $cartItem=CartItem::findOrFail($id);

                          // Vérifier que l'utilisateur est le propriétaire du panier
                     if($cartItem->user_id !=  Auth::id()){
                        abort(403,"action non autorisé");
                     }     

                     $cartItem->quantité=$request->quantité;
                     $cartItem->save();

                           return redirect()->route('cart.index')->with('message', 'Quantité mise à jour !');


            }

            public function delete($id){
                $cartItem=CartItem::findOrFail($id);

                if($cartItem->user_id != Auth::id()){
                    abort(403);
                };

                $cartItem->delete();

                return redirect()->back()->with('message', 'Produit supprimé du panier !');


            }

}
