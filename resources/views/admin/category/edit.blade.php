@extends('admin.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Category
                        <a href="{{ url('categories') }}" class="btn btn-sm btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('update-category/' . $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $category['name'] }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ $category['slug'] }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control">{{ $category['description'] }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                        @if (!empty($category['image']))
                            <img src="{{ asset('storage/' . $category['image']) }}" alt="Image" width="100" class="mt-2">
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
