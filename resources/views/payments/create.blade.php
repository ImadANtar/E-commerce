
<div class="container mt-5">
    <h2>Paiement à la livraison</h2>

    <div class="card mt-3 p-4">
        <p><strong>Total à payer :</strong> {{ number_format($order->total, 2) }} MAD</p>
        <p><strong>Statut de la commande :</strong> {{ $order->status }}</p>
        @if($order->status == 'pending')
        <form action="{{ route('payments.store', $order->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="address" class="form-label">Adresse de livraison :</label>
                <input type="text" name="address" id="address" class="form-control" required>
                @error('address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Téléphone :</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Confirmer la commande</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
        @else
              <p><strong>Commande déjà validée.</strong></p>
         @endif
    </div>
</div>

