@extends('layouts.app')

@section('content')

    <!-- Begin Page Content -->
    <div class="container" style="margin-top: 80px">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
            <a href="{{ route('admin') }}" class="btn btn-sm btn-danger shadow-sm">
                Back
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Product Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name"
                            value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="title">Product Price</label>
                        <input type="number" class="form-control" name="price" placeholder="Price"
                            value="{{ old('price') }}">
                    </div>
                    <div class="form-group">
                        <label for="title">Product Shipping Cost</label>
                        <input type="number" class="form-control" name="shipping_cost" placeholder="Shipping Cost"
                            value="{{ old('shipping_cost') }}">
                    </div>
                    <div class="form-group">
                        <label for="title">Product Quantity</label>
                        <input type="number" class="form-control" name="quantity" placeholder="Quantity"
                            value="{{ old('quantity') }}">
                    </div>
                    <div class="form-group">
                        <label for="travel_packages_id">Category</label>
                        <select name="travel_packages_id" required class="form-control">
                            <option value="">Choose Category</option>
                            @foreach ($categories as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" placeholder="Image">
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">
                        Simpan
                    </button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
