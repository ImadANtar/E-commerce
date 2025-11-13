
<div class="container mt-4">
    <h2>🛒 Mon Panier</h2>

    {{-- Message de succès --}}
    @if(session('message'))
        <div class="alert alert-success mt-2">
            {{ session('message') }}
        </div>
    @endif

    {{-- Vérifier si le panier est vide --}}
    @if($cartItems->count() > 0)
        <table class="table table-bordered mt-3" border="2">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp

                @foreach ($cartItems as $item)
                    @php
                        $subtotal = $item->product->price * $item->quantité;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ number_format($item->product->price, 2) }} DH</td>
                        <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
                                @csrf
                                @method('PUT')
                                
                                <input type="number" name="quantité" value="{{ $item->quantité }}" min="1" class="form-control w-50">
                                <button type="submit" class="btn btn-primary btn-sm ms-2">Mettre à jouuur</button>
                            </form>
                        </td>
                        <td>{{ number_format($subtotal, 2) }} DH</td>
                        <td>
                            <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('vous etes sure ') ">Supprimerrr</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="3" class="text-end"><strong>Total :</strong></td>
                    <td colspan="2"><strong>{{ number_format($total, 2) }} DH</strong></td>
                </tr>
            </tbody>
        </table>

        <form action="{{route('orders.store')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">🧾validé votre  commande</button>
        </form>

    @else
        <div class="alert alert-info mt-3">
            Votre panier est vide 
        </div>
    @endif
</div>

