<h1>Categories inderrx</h1>
<a href="{{ route('categories.create') }}">Create Category</a>



@if(session('message'))
    <p>{{ session('message') }}</p>
@endif



@if(count($categories) > 0)
    <table border="2">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th>action</th>
            
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href={{route('categories.edit',$category->id)}}>eddddit</a>
                        <form action={{route('categories.delete',$category->id)}} method="POST"  style="display:inline-block;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" onclick="return confirm('voulez vous supprimé?')">delete</button>
                        </form>
                     
                    </td>
                  
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>Pas de categories</p>
@endif
