<?php
                                            //Quand le client valide son panier → créer une commande.
                                            // Il enregistre les produits choisis + total.
namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(){
        $orders=Order::where('user_id',Auth::id())->latest()->get();
        return view('orders.index',compact('orders'));
    }

 public function store(){
    $userId = Auth::id();
    $cartItems = CartItem::where('user_id', $userId)->get();

    if($cartItems->isEmpty()){
        return redirect()->route('cart.index')->with('error','votre panier est vide.');
    }

    $total = 0;
    foreach($cartItems as $item){
        $total += $item->product->price * $item->quantité; // calcul total
    }

    DB::beginTransaction();

    try{
        // Créer la commande
        $order = Order::create([
            'user_id' => $userId,
            'total'   => $total,
            'status'  => 'pending',
        ]);

        //  Créer les order items
        foreach($cartItems as $item){
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity'   => $item->quantité, 
                'price'      => $item->product->price,
            ]);
        }

        // Vider le panier
        CartItem::where('user_id', $userId)->delete();

        DB::commit();
        return redirect()->route('orders.index')->with('message','Commande passée avec succès !');

    } catch(\Exception $e){
        DB::rollBack();
        return redirect()->route('cart.index')->with('error','Erreur lors du passage de commande');
    }
}


    public function show($id){
        $order=Order::with('items.product','payment')->where('user_id',Auth::id())->findOrFail($id);
        return view('orders.show',compact('order'));
    }
}
