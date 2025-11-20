<x-app-layout>
    <x-slot>

   <header>
            <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
   </header>

<h2>Liste des commandes</h2>

@if(session('message'))
    <p style="color: green">{{ session('message') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Client</th>
        <th>Total</th>
        <th>Status actuel</th>
        <th>Modifier status</th>
    </tr>

    @foreach($orders as $order)
      <tr>
    <td data-label="ID">{{ $order->id }}</td>
    <td data-label="Client">{{ $order->user->name }}</td>
    <td data-label="Total">{{ $order->total }} MAD</td>
    <td data-label="Status actuel">{{ $order->status }}</td>
    <td data-label="Modifier status">
        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <select name="status">
                <option value="pending"   {{ $order->status=='pending' ? 'selected' : '' }}>En attente</option>
                <option value="paid"      {{ $order->status=='paid' ? 'selected' : '' }}>Payé</option>
                <option value="skipped"   {{ $order->status=='skipped' ? 'selected' : '' }}>Ignoré</option>
                <option value="delivered" {{ $order->status=='delivered' ? 'selected' : '' }}>Livré</option>
                <option value="canceled"  {{ $order->status=='canceled' ? 'selected' : '' }}>Annulé</option>
            </select>
            <button type="submit">Mettre à jour</button>
        </form>
    </td>
</tr>

    @endforeach
</table>
 </x-slot>
</x-app-layout>