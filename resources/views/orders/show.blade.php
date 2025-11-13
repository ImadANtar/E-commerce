<h2>Détails de la commande #{{ $order->id }}</h2>

<table border="3">
<thead>
    <tr>
        <th>Produit</th>
        <th>Quantité</th>
        <th>Prix unitaire</th>
        <th>Sous-total</th>
    </tr>
</thead>
<tbody>
    <a href={{route('orders.index')}}>retour orders</a>
    @foreach($order->items as $item)
    <tr>
        <td>{{ $item->product->name }}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ number_format($item->price,2) }} MAD</td>
        <td>{{ number_format($item->price * $item->quantity,2) }} MAD</td>
    </tr>
    @endforeach
</tbody>
</table>

@if(!$order->payment)
    <h3>Paiement cash on delivery</h3>
    <form action="{{ route('payments.store', $order->id) }}" method="POST">
        @csrf
        <label>Adresse :</label>
        <input type="text" name="address" required><br>

        <label>Téléphone :</label>
        <input type="text" name="phone" required><br>

        <button type="submit">Confirmer la commande</button>
    </form>
@else
    <p><strong>Commande déjà enregistrée avec paiement cash on delivery.</strong></p>
@endif
