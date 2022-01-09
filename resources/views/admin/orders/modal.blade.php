


<div id="myOrder{{ $data->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-2">Order ID: <span class="text-primary">#{{ $data->order_number }}</span></p>
                <p class="mb-2">Billing Name: <span class="text-primary">{{ $data->user->getFullName() }}</span></p>
                <p class="mb-4">Billing Address: <span class="text-primary">{{ $data->shipping_address }}</span></p>

                <div class="table-responsive">
                    <table class="table align-middle table-nowrap">
                        <thead>
                            <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <th scope="row">
                                        <div>
                                            <img src="{{ $item->productImage() }}" alt="" class="{{ $item->name }}" width="125">
                                        </div>
                                    </th>
                                    <td>
                                        <div>
                                            <h5 class="text-truncate font-size-14">{{ $item->name }}</h5>
                                            <p class="text-muted mb-0">₱{{ number_format($item->pivot->price, 2) }} x {{ $item->pivot->quantity }}</p>
                                        </div>
                                    </td>
                                    <td>₱{{ number_format($item->pivot->sub_total, 2) }}</td>
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="2">
                                    <h6 class="m-0 text-right">Sub Total:</h6>
                                </td>
                                <td>
                                    ₱{{ number_format($order->sub_total, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h6 class="m-0 text-right">Delivery Charge:</h6>
                                </td>
                                <td>
                                    ₱30.00
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h6 class="m-0 text-right">Total:</h6>
                                </td>
                                <td>
                                    ₱{{ number_format($data->grand_total, 2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                @if ($data->status == 'order placed')
                    <a href="{{ route('admin-order.confirm', $data) }}" class="btn btn-primary waves-effect waves-light">Confirm Order</a>
                @elseif ($data->status == 'order confirm')
                    <a href="{{ route('admin-order.delivered', $data) }}" class="btn btn-success waves-effect waves-light">Order Delivered</a>
                @endif
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


