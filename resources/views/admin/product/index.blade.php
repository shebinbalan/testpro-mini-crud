@extends('admin.app')

@section('content')

{{-- <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Product List
                        <a href="{{ url('add-product') }}" class="btn btn-sm btn-primary float-end">Add Product</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $key => $product)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category ? $product->category->name : 'No Category' }}</td>
                                    <td>{{ $product->slug }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td> <img src="{{ asset('storage/' . $product['image']) }}" alt="Image" width="50" height="50"></td>
                                       
                                 
                                    <td>
                                        <a href="{{ url('edit-product/'.$product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ url('delete-product/'.$product->id) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Product List
                        <a href="{{ url('add-product') }}" class="btn btn-sm btn-primary float-end">Add Product</a>
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Export Buttons -->
                    <div class="mb-3">
                        <a href="{{ url('products/export?format=json') }}" class="btn btn-success btn-sm">Download JSON</a>
                        <a href="{{ url('products/export?format=xml') }}" class="btn btn-info btn-sm">Download XML</a>
                        <a href="{{ url('products/export?format=yaml') }}" class="btn btn-warning btn-sm">Download YAML</a>
                        <a href="{{ url('products/export?format=csv') }}" class="btn btn-secondary btn-sm">Download CSV</a>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Slug</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $key => $product)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category ? $product->category->name : 'No Category' }}</td>
                                    <td>{{ $product->slug }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td> <img src="{{ asset('storage/' . $product['image']) }}" alt="Image" width="50" height="50"></td>
                                    <td>
                                        <a href="{{ url('edit-product/'.$product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ url('delete-product/'.$product->id) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


<script>
    // Wait for the DOM to be fully loaded before attaching event handlers
    document.addEventListener('DOMContentLoaded', function () {
        // Find all forms with the class 'delete-form'
        let deleteForms = document.querySelectorAll('.delete-form');
        
        deleteForms.forEach(function(form) {
            form.addEventListener('submit', function(event) {
                // Show confirmation prompt before submitting the form
                let confirmation = confirm("Are you sure you want to delete this product?");
                if (!confirmation) {
                    // Prevent form submission if the user cancels
                    event.preventDefault();
                }
            });
        });
    });
</script>

