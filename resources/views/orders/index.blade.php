{{-- @if($errors->anny())
    @foreach ($errors as $error)
        <p>{{$error}}</p>
    @endforeach
    @endif --}}

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
       
        <td>{{$order->id}}</td>
        <td>{{$order->total}}</td>
        <td>{{$order->status}}</td>
        <td>{{$order->created_at->format('d/m/Y')}}</td>
        <td><a href={{route('orders.show',$order->id)}}>Voir</a></td>
        
    </tr>
    @endforeach
</table>