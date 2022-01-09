@extends('admin.master')

@section('content')

       <!-- start page title -->
       <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Products List</h4>


            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-sm-end">
                        <a href="{{ route('create.product') }}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i> Add New Product</a>
                        {{-- <a href="{{ route('products.create') }}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-plus me-1"></i> Add New Product</a> --}}
                    </div>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Regular Price</th>
                            <th>Sale Price</th>
                            <th>Quantity</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ $product->productImage() }}" alt="product-img" title="product-img" class="avatar-md">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ Str::limit($product->description, 50, ' ...')  }}</td>
                                <td>{{ $product->formatRegularPrice() }}</td>
                                <td>{{ $product->sale_price ? $product->formatSalePrice() : null }}</td>
                                <td>
                                    @if ($product->quantity > 0)
                                    {{ $product->quantity }}
                                    @else
                                    <span class="badge badge-pill badge-soft-danger font-size-12">Out of Stock</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-3">
                                        <a href="{{ route('edit.product', $product->slug) }}" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $product->id }}"><i class="mdi mdi-delete font-size-18"></i></a>

                                    </div>
                                </td>
                            </tr>

                            <div id="delete{{ $product->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel">Delete {{ $product->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <form method="POST" action="{{ route('products.destroy', $product) }}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="text-center">
                                                <h5>Are you sure? This data will be lost forever.</h5>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary waves-effect" data-bs-dismiss="modal">Submit</button>
                                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
