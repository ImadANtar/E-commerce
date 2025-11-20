<x-app-layout>
  <x-slot>
<header>
  <link rel="stylesheet" href="{{asset('css/products/create.css')}}">
</header>

<h1>create categoy</h1>
@if(session('message'))
<h4>{{session('message')}}</h4>
@endif

@if(count($errors)>0)
@foreach($errors->all() as $error)
<h4>{{$error}}</h4>
@endforeach
@endif
<a href={{route('products.index')}}>retourn a cat index</a>
<form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
    @csrf

        <label >Category_name</label><br>
        <select name="category_id" >
          @foreach ($categories as $category)
              <option value={{$category->id}}>{{$category->name}}</option>
          @endforeach
        </select>
        <label for="name">name:</label><br>
        <input type="text"  name="name" ><br>

        <label for="description">description</label><br>
        <input type="text"  name="description" ><br>

        <label for="price">price:</label><br>
        <input type="text"  name="price" ><br>

        <label for="stock">stock:</label><br>
        <input type="text"  name="stock" ><br>

        <label for="name">First namffe:</label><br>
                  <input type="file" name="image" id="image" accept="image/*" >


  <button type="submit" >Submiiiit</button>

</form>

  </x-slot>
</x-app-layout>