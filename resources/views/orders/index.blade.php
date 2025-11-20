<x-app-layout>
<x-slot>
<link rel="stylesheet" href="{{asset('css/orders/index.css')}}">

@if(session('message'))
    <p>{{session('message')}}</p>
@endif

<h2>Mes commandes</h2>

<table border="4">
    <tr>
        <th>Id</th>
        <th>Total</th>
        <th>Status</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

 @foreach($orders as $order)
    <tr>
       
 <td data-label="Id">{{$order->id}}</td>
    <td data-label="Total">{{$order->total}} DH</td>
    <td data-label="Status">{{$order->status}}</td>
    <td data-label="Date">{{$order->created_at->format('d/m/Y')}}</td>
    <td data-label="Action"><a href="{{route('orders.show',$order->id)}}">Voir</a></td>
        
    </tr>
    @endforeach
</table>
</x-slot>
</x-app-layout>