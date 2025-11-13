
<div class="container mt-5">
    <h1>Liste des produits</h1>
<a href={{route('products.create')}}>createde prod</a>
@if(session('message'))
<p>{{session('message')}}</p>
@endif
    @if($products->count() > 0)
    <table border="5">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Catégorie</th>
                <th>Image</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description ?? '-' }}</td>
                <td>{{ number_format($product->price, 2) }} DH</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->category->name ?? 'Non défini' }}</td>
                <td>
                    @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="90">
                    @else
        -
                    @endif
                </td>
                  <td>
                <a href={{route('products.edit',$product->id)}} style="display:inline-block;">edit prod</a>
                <form action={{route('products.delete',$product->id)}} method="POST">
                    @csrf
                    @method('DELETE')
              
                      <button type="submit" onclick="return confirm('voulez vous supprimé?')">delete</button>
                </form>
                <form action={{route('cart.add')}} method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}"/>
                    <input type="number" name="quantité" value="1" min="1">
                    <button>ajouter au panieeer</button>
                </form> 
            </td>
            </tr>
          
            @endforeach

            <script>
                document.addEventListener('DOMContentLoaded',function(){
                    //selection la button add
                    const buttons= document.querySeletorAll('.add-to-cart');

                    buttons.forEach(button=>{
                        button.addEventListener('click',function(){

                            const productId=this.getAttribute('data-product-id');

                            fetch('/cart/add',{
                                method:'POST',
                                headers:{
                                    'Content-Type':'application/json', //format json
                                    'X-CSRF-TOKEN':'{{csrf_token()}}'
                                },

                                body: JSON.stringify({'product_id':productId}) //donnée envoyé
                            })
                            .then(response=>response.json()) //on attend une résponse Json

                            .then(data=>{
                                document.getElementById('cart-message').textContent=data.message;
                            })
                            .catch(error=>{
                                console.error('Erreur AJAX',error);
                            });
                        });
                    });
                });
            </script>
        </tbody>
    </table>
    @else
        <p>Aucun produit trouvé.</p>
    @endif
</div>

