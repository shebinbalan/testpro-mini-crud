@extends('admin.app')
@section('content')
<section class="products-grid container">
    <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">Featured Products</h2>
    <div class="row g-4"> <!-- g-4 adds gap between columns -->
        @foreach($products as $product)
        <div class="col-6 col-md-4 col-lg-4">
            <div class="product-card product-card_style3 mb-3"> <!-- Border added here -->
                <div class="pc__img-wrapper">
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" width="330" height="400"
                    alt="{{$product->name}}" class="pc__img">
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $product->name }}</h2>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mt-2">{{ $product->description }}</p>
                        <p class="text-red-500 font-bold text-lg mt-2">₹{{ number_format($product->price, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div><!-- /.row -->
    
  
    

   
  </section>
</div>
@endsection
