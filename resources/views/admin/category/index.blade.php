@extends('admin.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Category List
                        <a href="{{ url('add-category') }}" class="btn btn-sm btn-primary float-end">Add Category</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($categories as $category)
                           <td>#</td>
                           <td>{{$category->name}}</td>
                           <td>{{$category->slug}}</td>
                           <td>{{$category->description}}</td>
                           <td> <img src="{{ asset('storage/' . $category['image']) }}" alt="Image" width="50" height="50"></td>
                           <td>
                            <a href="{{ url('edit-category/' . $category['id']) }}" class="btn btn-sm btn-warning">Edit</a>
                        </td>
                        <td>
                            <form action="{{ url('delete-category/' . $category['id']) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
