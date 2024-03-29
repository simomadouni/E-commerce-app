@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12 ">
        @if (session('message'))
        <div class="alert alert-success" >{{ session('message') }}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4>PRODUCTS
                <a href="{{ url('admin/products/create') }}" class="btn btn-primary btn-sm text-white float-end">Add Products</a></h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Famille</th>
                            <th>Sous-Famille</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product )
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if ($product->category)
                                {{ $product->category->name }}
                                @else
                                    No Category
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->selling_price }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->status =='1' ? 'Hidden':'Visible' }}</td>
                            <td>
                                <a href="{{ url('admin/products/'.$product->id.'/edit') }}" class="btn btn-sm btn-success">EDIT</a>
                                <a href="{{ url('admin/products/'.$product->id.'/delete') }}" onclick="return confirm('Are you sure')" class="btn btn-sm btn-danger">DELETE</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">No Product</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection



