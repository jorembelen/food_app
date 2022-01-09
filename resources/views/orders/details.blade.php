@extends('layouts.master')

@section('content')


    <div class="confirm-wrap" style="transform: none;">
        <!-- Container -->
        <div class="container" style="transform: none;">
            <!-- Row -->
            <div class="row" style="transform: none;">
                <!-- Left Sidebar -->
                <div class="col-lg-12" id="mainContent" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                    <!-- Filter Area -->


                <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;"><h3>Order Details:</h3>
                    <table class="tbl-cart" cellpadding="10" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-left">Name</th>
                                <th class="table-th">Unit Price (₱)</th>
                                <th class="table-th">Quantity</th>
                                <th class="table-th">Total Price (₱)</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($order->items as $item)
                            <tr class="product-title-resp">
                                <td class="text-left"><img src="{{ $item->productImage() }}" alt="" width="100"><span class="inline-block title-width ml-4">{{ $item->name }}</span></td>
                                <td data-label="Price" class="table-td">{{ number_format($item->pivot->price, 2) }}</td>
                                <td data-label="Quantity" class="table-td">{{ $item->pivot->quantity }}</td>
                                <td data-label="Total" class="table-td"><strong>{{ number_format($item->pivot->sub_total, 2) }}</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h3>Amount:</h3><div>
                        </div><div>
                            <strong>Sub Total: </strong><span>{{ number_format($order->sub_total, 2) }}</span>
                        </div><div>
                            <strong>Delivery: </strong><span>30.00</span>
                        </div><div>
                            <strong><h4>Total: ₱{{ number_format($order->grand_total, 2) }}</h4></strong>
                        </div><p class="mb-0"><a href="{{ route('orders') }}" class="btn-2">Back</a></p><div class="resize-sensor" style="position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden;"><div class="resize-sensor-expand" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;"><div style="position: absolute; left: 0px; top: 0px; transition: all 0s ease 0s; width: 1290px; height: 485px;"></div></div><div class="resize-sensor-shrink" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;"><div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%"></div></div></div></div></div>
            </div>
        </div>
    </div>


@endsection
