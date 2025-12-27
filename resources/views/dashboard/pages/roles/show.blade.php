@extends('layouts.dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active"> a Categories</li>
    <li class="breadcrumb-item active">{{$category->name}}</li>
@endsection
@section('page_title')
    Create Categories
@endsection
@section('title', 'Categories')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Products Table</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">

                        </div>
                    </div>
                </div>


                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Store</th>
                                <th>Price</th>
                                <th>Description</th>
                           
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category->products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>

                                    <td>{{ $product->store->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->description }}</td>
                                   
                                </tr>
                            @endforeach
                            <tr>
                            </tr>


                        </tbody>
                    </table>
                    
                    {{-- ونضع هذا الكود في صفحة العرض أي صفحة ال index
                    ملاحظة مهمة لتعمل هذه الدالة يجب وضع قيمة لل paginate في الكونترولر يعني العدد 10 ونحط قيمة جوات ال
                    paginate
                    ويعمل --}}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
@push('styles')
    <style>
        .alert {
            margin-top: 10px
        }
    </style>
@endpush
@push('stripts')

@endpush