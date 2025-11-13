<?php
                                    //Pour enregistrer ou afficher le statut du paiement de la commande.
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class PaymentController extends Controller
{
    public function create($orderId){
        $order=Order::where('user_id',Auth::id())->findOrFail($orderId);
       
        return view('payments.create',compact('order'));

        if($order->status === "paid"){
            return redirect()->route('orders.show',$order->id)->with('message', 'Cette commande a déjà été payée.');
        }

         return view('payments.create', compact('order'));
    }

    public function store(Request $request , $orderId){

            $order=Order::where('user_id',Auth::id())->findOrFAil($orderId);

            //Vérifie si la commande a déjà un paiement
            if($order->payment){
                return redirect()->route('orders.show',$order->id)->with('error', 'Cette commande a déjà été traitée.');
            }
            $request->validate([
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
            ]);

            DB::beginTransaction();

            try{
                $payment=Payment::create([

                    'order_id'=>$order->id,
                    'payment_method'=>'cash_on_delivery',
                    'amount'=>$order->total,
                    'payment_status'=> 'pending',
                    'address' => $request->address,
                    'phone' => $request->phone,
                    
                ]);

                //mettre a jour la commande
                $order->status='pending'; // en attente de livraison
                $order->save();
                DB::commit();

                return redirect()->route('orders.index',$order->id)->with('message', 'Votre commande a été enregistrée avec succès ! Le paiement se fera à la livraison');
            }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('orders.show', $order->id)
                             ->with('error', 'Erreur lors du paiement : ' . $e->getMessage());
        }
    }

    
}
