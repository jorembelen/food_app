
         <div>

            <style>
                .button {
                  background-color: #f25c04; /* Green */
                }

                </style>


            <!-- Row -->
            <div class="row">


                <!-- Left Sidebar -->
                <div class="col-lg-8" id="mainContent">
                    @if (session()->has('message'))
                        <div class="alert alert-danger">
                            {{ session('message') }}
                        </div>
                    @endif
                    <!-- Filter Area -->
                    <div class="row filter-box filters">
                        <div class="filter-box-header">
                            <h3>Search</h3>
                            <a href="#" wire:click.prevent="refresh"><span class="filter-box-link">Clear Search</span></a>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="search-wrap">
                                <input type="text" class="form-control" placeholder="Search products here ..." wire:model="query" />
                                <i class="icon icon-search"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Filter Area End -->


                    <!-- Grid -->
                    <div class="row grid">
                        @foreach ($products as $product)
                            <!-- Grid Item 01 -->
                            <div  class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="item-body">
                                    <figure>
                                        <img src="{{ $product->productImage() }}" data-src="{{ $product->productImage() }}" class="img-fluid lazy" alt="">
                                            <a href="#" class="item-body-link modal-opener" wire:click.prevent="info('{{ $product->slug }}')">
                                            <div class="item-title">
                                                <h3>{{ $product->name }}</h3>
                                                <small>{{ Str::limit($product->description, 40, ' ...')  }}</small>
                                            </div>
                                        </a>
                                        @if ($product->quantity == 0)
                                        <div class="ribbon-size"><span>Out of Stock</span></div>
                                        @endif
                                    </figure>
                                    <ul>
                                        @if ($product->sale_price)
                                            <li>
                                                <span class= "ml-4"><i class="fa fa-money-check"></i> {{ $product->formatSalePrice() }}</span>
                                            </li>
                                            <li>
                                                <span class="item-price-discount text-danger">{{ $product->formatRegularPrice() }}</span>
                                            </li>
                                            @else
                                            <li>
                                                <span class= "ml-4">{{ $product->formatRegularPrice() }}</span>
                                            </li>
                                        @endif
                                        <li>
                                            <a href="#"  wire:click.prevent="addToCart('{{ $product->id }}')"><i class="fa fa-cart-plus"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        @endforeach

                    </div>
                    <!-- Grid End -->

                    @if ($allProducts > $amount)
                    <div class="text-center pb-4">
                            @if ($allProducts > 4 && $allProducts > $amount)
                            <div wire:loading.remove wire:target="load">
                            <button type="button" class="btn button button1 rounded-pill" wire:click.prevent="load">
                                <i class="fa fa-refresh"></i> Load more products
                            </div>
                            </button>
                            <div wire:loading wire:target="load">
                                <button class="btn button rounded-pill" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>
                            </div>

                        @else
                        <button type="button" class="btn button rounded-pill" >
                            <i class="ci-loading"></i> End ... Showing {{ $allProducts }} of {{ $allProducts }}
                        </button>
                        @endif
                        </ul>
                    </div>
                @endif


                </div>

                <!-- Left Sidebar End -->
                <!-- Right Sidebar -->
                <div class="col-lg-4" id="sidebar">
                    <!-- Order Container -->
                    <div id="orderContainer" class="theiaStickySidebar">
                        <!-- Form -->

                        @if ($hideOrder)
                                <!-- Step 1: Order Summary -->
                                <div  class="step">
                                <div class="order-header">
                                    <h3>Order Summary 1/2</h3>
                                </div>
                                <div class="order-body">
                                    <!-- Cart Items -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="order-list">
                                                @auth
                                                    @forelse ($carts as $cart)
                                                <ul>
                                                <li>
                                                    <div class="order-list-img">
                                                        <img src="{{ $cart->product->productImage() }}" alt="">
                                                    </div>
                                                    <div class="order-list-details">
                                                        <h4>{{ $cart->product->name }}<br>
                                                            <small>{{ Str::limit($cart->product->description, 20, ' ...')  }} </small>
                                                            </h4>
                                                            <div class="qty-buttons">
                                                                <input type="button" value="+" class="qtyplus" name="plus" wire:click.prevent="increaseQty('{{ $cart->product_id }}')">
                                                                <input type="text" name="qty" value="{{ $cart->quantity }}" class="qty form-control">
                                                                <input type="button" value="-" class="qtyminus" name="minus" wire:click.prevent="decreaseQty('{{ $cart->product_id }}')">
                                                            </div>
                                                            <div class="order-list-price">{{ $cart->product->formatCartPrice() }}</div>
                                                            <div class="order-list-delete">
                                                                <a href="#" wire:click.prevent="destroy('{{ $cart->product_id }}')"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @empty
                                                    <div class="order-list-img">
                                                        <img src="/frontend/assets/img/bg/empty-cart-small.jpg" alt="Your cart is empty"/>
                                                    </div>
                                                    <div class="order-list-details">
                                                        <h4>Your cart is empty</a><br/><small>Start adding items</small></h4>
                                                        <div class="order-list-price">0.00</div>
                                                    </div>

                                                </ul>
                                                @endforelse
                                            @endauth
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cart Items End -->
                                    <!-- Delivery Fee -->
                                    <div class="row mt-2">
                                        <div class="col-md-12 col-sm-12">
                                            <label class="cbx radio-wrapper no-edges">
                                                <input type="radio" value="delivery" name="transfer" checked> <span class="checkmark"></span>
                                                <span class="radio-caption">Delivery</span><span class="option-price transfer">30.00</span>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Delivery Fee -->
                                    <!-- Total -->
                                    <div class="row total-container">
                                        <div class="col-md-12 p-0">
                                            @if ($carts->count() > 0)
                                                <span class="totalTitle">Total</span><span class="float-right">₱{{ number_format($cartTotal + 30, 2) }}</span>
                                            @else
                                                <span class="totalTitle">Total</span><span class="float-right">₱0.00</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div id="totalError"></div>
                                    <!-- Total End -->
                                    <!-- Forward Button -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" name="forward" class="btn-form-func forward" wire:click.prevent="openDiv">
                                                <span class="btn-form-func-content">Continue Order</span>
                                                <span class="icon"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Forward Button End -->
                                </div>
                            </div>
                            <!-- Step 1: Order Summary End -->
                        @endif

                        @auth
                        @if ($show)
                        <!-- Step 2: Checkout -->
                    <div >
                        <div class="order-header">
                            <h3>Order Summary 2/2</h3>
                        </div>
                        <div>

                            <div class="order-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="userNameOnlinePayment">Receivers Name</label>
                                            <input  class="form-control" wire:model="name" type="text" required />
                                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="phoneOnlinePayment">Phone  09123456789</label>
                                            <input  class="form-control" wire:model="mobile" type="text" required />
                                            @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="addressOnlinePayment">Delivery Address</label>
                                            <input  class="form-control" wire:model="address" type="text"  placeholder="Please indicate your complete address" />
                                            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="messageOnlinePayment">Notes</label>
                                            <input  class="form-control" wire:model="notes" type="text"  required />
                                            @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row total-container">
                                    <div class="col-md-12 p-0">
                                        <span class="totalTitle">Total</span><span class="totalValue float-right">₱{{ number_format($cartTotal, 2) }}</span>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-6 pr-0">
                                        <div class="form-group">
                                            <input type="checkbox"  class="form-controls" wire:model="terms" value="yes" required />
                                            @error('terms') <span class="text-danger">{{ $message }}</span> @enderror

                                                <span>Accept<a href="https://ultimatewebsolutions.net/foodboard/pdf/terms.pdf" class="terms-link" target="_blank">Terms</a>.</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6 pl-0">
                                        <a href="javascript:;" class="modify-order backward">Modify Order</a>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <button  class="btn-form-func" wire:click.prevent="order">
                                            <span class="btn-form-func-content">Submit</span>
                                            <span class="icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                        </button>
                                        <div class="spinner-icon">
                                            <i class="fa fa fa-cog fa-spin"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" name="backward" class="btn-form-func btn-form-func-alt-color backward" wire:click.prevent="back">
                                            <span class="btn-form-func-content">Back</span>
                                            <span class="icon"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="row footer">
                                    <div class="col-md-12 text-center">
                                        <small>Copyrigth JOREB|Store 2021.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Step 2: Checkout End -->
                  @endif
                        @endauth

                    </div>
                    <!-- Order Container End -->
                </div>
                <!-- Right Sidebar End -->
            </div>
            <!-- Row End -->


            @foreach ($products as $data)
                        <!-- Modal Details for Item 01 -->
                        <div  wire:ignore.self id="productDetails{{ $data->id }}" class="modal-popup zoom-anim-dialog mfp-hide">
                            <div class="small-dialog-header">
                                <h3>{{ $data->name }}</h3>
                            </div>
                            <div class="content pb-1">
                                <figure><img src="{{ $data->productImage() }}" alt="" class="img-fluid"></figure>
                                <h6 class="mb-1">Product Details</h6>
                                <p>{{ $data->description }}</p>
                            </div>
                            <div class="footer">
                                <div class="row">
                                    <div class="col-4 pr-0">
                                        <button type="button" class="btn-modal-close" >Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Details for Item 1 End -->
            @endforeach

 </div>
