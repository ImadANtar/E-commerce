<h1>create categoy</h1>
@if(session('message'))
<h4>{{session('message')}}</h4>
@endif

@if(count($errors)>0)
@foreach($errors->all() as $error)
<h4>{{$error}}</h4>
@endforeach
@endif
<a href={{route('categories.index')}}>retourn a cat index</a>
<form action="{{route('categories.store')}}" method="POST">
    @csrf

        <label for="name">First name:</label><br>
  <input type="text"  name="name" ><br>

  <button type="submit" >Submit</button>

</form>

