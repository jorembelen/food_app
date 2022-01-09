<div>

            <!-- Modal Details for Item 01 -->
            <div>
                <div class="small-dialog-header">
                    <h3>{{ $product->name }}</h3>
                </div>
                <div class="content pb-1">
                    <figure><img src="{{ $product->productImage() }}" alt="" class="img-fluid">
                        @if ($product->quantity == 0)
                        <div class="ribbon-size"><span>Out of Stock</span></div>
                        @endif
                    </figure>
                    <div class="pl-0">
                     @if ($product->sale_price)
                         <span><i class="fa fa-money-check"></i> {{ $product->formatSalePrice() }}</span>
                         <span class="item-price-discount text-danger">{{ $product->formatRegularPrice() }}</span>
                     @else
                         <span>{{ $product->formatRegularPrice() }}</span>
                     @endif
                    </div>


                    <h6 class="mb-1 mt-2">Product Info</h6>
                    <p>{{ $product->description }}</p>

                </div>
                <div class="footer">
                    <a href="/" type="button" class="btn btn-primary text-center"><i class="fa fa-arrow-left" style="color: white"></i> Return</a>
                    <a href="#" type="button" class="btn btn-success text-center"  wire:click.prevent="addToCart('{{ $product->id }}')"><i class="fa fa-cart-plus" style="color: white"></i> Add to Cart</a>

                    </div>
                </div>
                <div class="mt-4">
                    <h5>You may also like</h5>
                          <!-- Grid -->
                          <div class="row grid">
                            @foreach ($products as $item)
                                <!-- Grid Item 01 -->
                                <div  class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                    <div class="item-body">
                                        <figure>
                                            <img src="{{ $item->productImage() }}" data-src="{{ $item->productImage() }}" class="img-fluid lazy" alt="">
                                                <a href="#" type="button" class="item-body-link modal-opener" wire:click.prevent="info('{{ $item->slug }}')">
                                                <div class="item-title">
                                                    <h3>{{ $item->name }}</h3>
                                                    <small>{{ Str::limit($item->description, 40, ' ...')  }}</small>
                                                </div>
                                            </a>
                                            @if ($item->quantity == 0)
                                            <div class="ribbon-size"><span>Out of Stock</span></div>
                                            @endif
                                        </figure>
                                        <ul>
                                            @if ($item->sale_price)
                                                <li>
                                                    <span class= "ml-4"><i class="fa fa-money-check"></i> {{ $item->formatSalePrice() }}</span>
                                                </li>
                                                <li>
                                                    <span class="item-price-discount text-danger">{{ $item->formatRegularPrice() }}</span>
                                                </li>
                                                @else
                                                <li>
                                                    <span class= "ml-4">{{ $item->formatRegularPrice() }}</span>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="#" type="button" wire:click.prevent="addToCart('{{ $item->id }}')"><i class="fa fa-cart-plus"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                        <!-- Grid End -->
                </div>
            </div>


</div>
