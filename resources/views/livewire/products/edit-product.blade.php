<div>

      <!-- start page title -->
      <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Update {{ $name }}</h4>



            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <p class="card-title-desc">Fill all information below</p>

                    <form wire:submit.prevent="update" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="productname">Product Name</label>
                                    <input value="{{ $name }}" wire:model.lazy="name" type="text" class="form-control" placeholder="Product Name">
                                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="price">Regular Price</label>
                                    <input value="{{ $regular_price }}" wire:model.lazy="regular_price" type="number" min="1" class="form-control" placeholder="regular price">
                                    @error('regular_price') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="price">Sale Price</label>
                                    <input value="{{ $sale_price }}" wire:model.lazy="sale_price" type="number" min="1" class="form-control" placeholder="sale price">
                                    @error('sale_price') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="control-label">Is Featured?</label>

                                    <select class="select2 form-control" wire:model.lazy="is_featured" data-placeholder="Choose ...">
                                        <option value="{{ $is_featured }}">{{ $is_featured == 0 ? 'No' : 'Yes' }}</option>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                    @error('is_featured') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="control-label">Quantity</label>
                                    <input value="{{ $quantity }}" wire:model.lazy="quantity" type="number" min="1" class="form-control" placeholder="quantity">
                                    @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="productdesc">Product Description</label>
                                    <textarea class="form-control" wire:model.lazy="description" rows="5" placeholder="Product Description">{{ $description }}</textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                            </div>
                        </div>


                        <div class="fallback" wire:ignore>
                            <input type="file" wire:model.lazy="image" class="dropify" data-min-height="400" data-default-file="{{ asset('uploads/images/' .$image) }}">
                        </div>
                        <div class="text-center">
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <div wire:loading.remove wire:target="update">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Submit</button>
                                </div>
                            <div wire:loading wire:target="update">
                                <button class="btn btn-danger waves-effect waves-light" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Processing ...
                                </button>
                            </div>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary waves-effect waves-light">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
    <!-- end row -->

</div>
