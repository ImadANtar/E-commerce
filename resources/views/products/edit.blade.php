<x-app-layout>
  <x-slot>
<header>
  <link rel="stylesheet" href="{{asset('css/products/edit.css')}}">
</header>

<h1>edit prod</h1>
@if(session('message'))
<h4>{{session('message')}}</h4>
@endif

@if(count($errors)>0)
@foreach($errors->all() as $error)
<h4>{{$error}}</h4>
@endforeach
@endif
<a href={{route('products.index')}}>retourn a prod index</a>
<form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <label >Category_name</label><br>
        <select name="category_id" >
          @foreach ($categories as $category)
              <option value={{$category->id}}>{{$category->name}}</option>
          @endforeach
        </select>
        <label for="name">name:</label><br>
        <input type="text"  name="name" value="{{old('name',$product->name)}}"><br>

        <label for="description">description</label><br>
        <input type="text"  name="description" value="{{old('description',$product->description)}}"><br>

        <label for="price">price:</label><br>
        <input type="text"  name="price" value="{{old('price',$product->price)}}" ><br>

        <label for="stock">stock:</label><br>
        <input type="text"  name="stock" value="{{old('stock',$product->stock)}}"><br>

        <label>First namffe:</label><br>
                  <input type="file" name="image" id="image" accept="image/*" value="{{old('image',$product->image)}}" >  


  <button type="submit" >Submiiiit</button>

</form>

  </x-slot>
</x-app-layout>