<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'user_id',
        'total',
        'status',
        'address',
        'phone',
        
    ];

     // Commande appartient à un utilisateur
    public function user(){
      return  $this->belongsTo(User::class);
    }

    // Une commande peut avoir un paiement
    public function payment(){
       return $this->hasOne(Payment::class);
    }

    // Une commande peut avoir plusieurs order items
    public function items(){
        return $this->hasMany(OrderItem::class);
    }
}
