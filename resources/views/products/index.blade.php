<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Produits
        </h2>
        <link rel="stylesheet" href="{{ asset('css/products/index.css') }}">
    </x-slot>

    <div class="products-container">

        {{-- Bouton Add Product si admin --}}
        @auth
            @if($user->role === 'admin')
                <div class="add-product-wrapper">
                    <a href="{{ route('products.create') }}" class="add-product-btn">+ Add Product</a>
                    <a href="{{ route('admin.orders.index') }}" class="add-product-btn"> Voir les commande</a>

                </div>

            @endif
        @endauth
        @auth
        @if($user->role==='user')
        <div class="add-product-wrapper">
             <a href="{{route('orders.index')}}" class="add-product-btn">orders</a>
             </div>
         @endif
        @endauth
 
        <div class="products-grid">
            @foreach($products as $product)
               
                    
                    {{-- IMAGE --}}
                    <div class="product-card">
    <div class="product-img">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        @else
            <img src="" alt="No image">
        @endif
    </div>

                    {{-- NOM --}}
                    <h3 class="product-title">{{ $product->name }}</h3>

                    {{-- DESCRIPTION --}}
                    <p class="product-description">{{ $product->description }}</p>

                    {{-- PRIX --}}
                    <p class="product-price">{{ $product->price }} MAD</p>

                    {{-- BOUTONS ADMIN --}}
                    @auth
                        @if($user->role === 'admin')
                            <div class="admin-buttons">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn edit-btn">Edit</a>

                                <form action="{{ route('products.delete', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn delete-btn" onclick="return confirm('vous etes sure de supprimer?')">Delete</button>
                                </form>
                            </div>
                        @endif
                    @endauth

                    {{-- BOUTON CLIENT --}}
                    @auth
                      
                        @if($user->role === 'user')
                      
                            <form action="{{ route('cart.add') }}" method="POST" class="cart-form">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="number" name="quantité" value="1" min="1" class="qty">
                                <button class="btn cart-btn">Ajouter au panier</button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn login-btn">Ajouter au panier</a>
                       
                    @endauth

                </div>
            @endforeach
           
                       
        </div>

    </div>
</x-app-layout>
