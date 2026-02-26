@extends('admin.layouts.app')

@section('title')
    Products
@endsection

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')
        <div class="col-md-9">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="mt-2">Products ({{ $products->count() }})</h3>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <hr>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Colors</th>
                                <th scope="col">Sizes</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Image</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key => $product)
                                <tr>
                                    <th scope="row">{{ $key += 1 }}</th>
                                    <th>{{ $product->name }}</th>
                                    <th>
                                        @foreach($product->colors as $color)
                                            <span class="badge bg-light text-dark">
                                                {{ $color->name }}
                                            </span>
                                        @endforeach
                                    </th>
                                    <th>
                                        @foreach($product->sizes as $size)
                                            <span class="badge bg-light text-dark">
                                                {{ $size->name }}
                                            </span>
                                        @endforeach
                                    </th>
                                    <th>{{ $product->qty }}</th>
                                    <th>{{ $product->price }}</th>
                                    <th>
                                        <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}"
                                             width="60" height="60"
                                             class="img-fluid rounded">
                                    </th>
                                    <th>
                                        @if($product->status)
                                            <span class="badge bg-success p-2">
                                                In stock
                                            </span>
                                        @else
                                            <span class="badge bg-danger p-2">
                                                Out of stock
                                            </span>
                                        @endif
                                    </th>
                                    <th>
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#"
                                           onclick="deleteItem({{ $product->id }})"
                                           class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <form id="{{ $product->id }}"
                                              action="{{ route('admin.products.destroy', $product) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </th>
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