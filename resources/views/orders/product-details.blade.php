@extends('layouts.master')

@section('content')


            <!-- Modal Details for Item 01 -->
            <div>
                <div class="small-dialog-header">
                    <h3>{{ $product->name }}</h3>
                </div>
                <div class="content pb-1">
                    <figure><img src="{{ $product->productImage() }}" alt="" class="img-fluid"></figure>

                    <h6 class="mb-1">Product Details</h6>
                    <p>{{ $product->description }}</p>

                </div>
                <div class="footer">
                    <a href="/" type="button" class="btn btn-primary text-center">Back</a>
                    <a href="/" type="button" class="btn btn-success text-center"><i class="fa fa-cart-plus"></i> Add to Cart</a>

                    </div>
                </div>
            </div>

@endsection
