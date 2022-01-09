@extends('admin.master')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Add Product</h4>



            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Basic Information</h4>
                    <p class="card-title-desc">Fill all information below</p>

                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" id="product-create">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="productname">Product Name</label>
                                    <input id="productname" name="name" type="text" class="form-control" placeholder="Product Name">
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="price">Regular Price</label>
                                    <input id="price" name="regular_price" type="text" class="form-control" placeholder="regular price">
                                    @error('regular_price') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="price">Sale Price</label>
                                    <input id="price" name="sale_price" type="text" class="form-control" placeholder="sale price">
                                    @error('sale_price') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="control-label">Is Featured?</label>

                                    <select class="select2 form-control" name="is_featured" data-placeholder="Choose ...">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                    @error('is_featured') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="control-label">Quantity</label>
                                    <input name="quantity" type="number" min="1" class="form-control" placeholder="quantity">
                                    @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="productdesc">Product Description</label>
                                    <textarea class="form-control" name="description" rows="5" placeholder="Product Description"></textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                            </div>
                        </div>


                        <div class="fallback" wire:ignore>
                            <input type="file" name="image" class="dropify" data-min-height="400" data-default-file="">
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                           <div class="d-flex flex-wrap gap-2 mt-4">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">Submit</button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary waves-effect waves-light">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
    <!-- end row -->

@endsection
