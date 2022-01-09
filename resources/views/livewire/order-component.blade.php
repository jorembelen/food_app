<div>

    <div class="row">
        <!-- Faq Cards -->
        <div class="col-lg-12">
            <!-- Topic 1 -->

            <div role="tablist" class="faq-accordion" id="topic1">
                <!-- Card 1 -->
                <div class="card">

                    <div id="subTopic1" class="collapse show" role="tabpanel" data-parent="#topic1">
                        <div class="card-body">
                            <div><h3>Order List:</h3>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order No.</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('order.details', $order->order_number) }}">{{ $order->order_number }}</a></td>
                                            <td>{{ $order->item_count }}</td>
                                            <td>₱{{ number_format($order->grand_total, 2) }}</td>
                                            <td>
                                                <span class="badge badge-{{ $order->status == 'cancelled' ? 'danger' : 'success' }}">{{ $order->status }}</span>
                                            </td>
                                            <td>
                                                @if ($order->status == 'order placed')
                                                    <button type="button" class="btn btn-primary btn-sm btn-rounded" wire:click.prevent="confirm('{{ $order->id }}')">
                                                    Cancel
                                                    </button>
                                                @elseif ($order->status == 'cancelled')
                                                <button type="button" class="btn btn-warning btn-sm btn-rounded" wire:click.prevent="reorder('{{ $order->id }}')">
                                                    Reorder
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $orders->links('pagination::bootstrap-4') }}

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->

            </div>

        </div>
        <!-- Faq Cards End -->
    </div>

</div>
