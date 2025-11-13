<h1>edit cat</h1>

@if(session('message'))
<h4>{{session('message')}}</h4>
@endif

@if(count($errors)>0)
@foreach($errors->all() as $error)
<h4>{{$error}}</h4>
@endforeach
@endif

<form action={{route('categories.update',$category->id)}} method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{old('name',$category->name)}}"/>
    <button type="submit">submit</button>
</form>


