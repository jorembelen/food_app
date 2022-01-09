<div>

      <div class="row pt-4 pb-4">
          <div class="col-md-4">


                    @if ($hideOrder)
                             <!-- Step 1: Order Summary -->
                             <div  class="step">
                                <div class="order-header">
                                    <h3 class="text-light ml-2">Order Summary 1/2</h3>
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
                                                        <img src="/assets/img/bg/empty-cart-small.jpg" alt="Your cart is empty"/>
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
                                        <div class="col-md-12 p-0 pb-2">
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

                      @if ($show)
                            <!-- Step 2: Checkout -->
                        <div >
                            <div class="order-header">
                                <h3 class="text-light ml-2">Order Summary 2/2</h3>
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
                                                <input  class="form-control" wire:model="mobile" type="text" value="{{ auth()->user()->mobile }}" required />
                                                @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="addressOnlinePayment">Delivery Address</label>
                                                <input  class="form-control" wire:model="address" type="text"  required />
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
                                        <div class="col-md-12 p-0 pb-2">
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

                <!-- Order Container End -->

      </div>

</div>
