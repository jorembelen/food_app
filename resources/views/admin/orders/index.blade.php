@extends('admin.master')

@section('content')

       <!-- start page title -->
       <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Orders List</h4>


            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Order No.</th>
                            <th>Customers Name</th>
                            <th>No. of Items</th>
                            <th>Sub Total</th>
                            <th>Grand Total</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->user->getFullName() }}</td>
                                <td>{{ $order->item_count }}</td>
                                <td>{{ number_format($order->sub_total, 2) }}</td>
                                <td>{{ number_format($order->grand_total, 2) }}</td>
                                <td>
                                    {{ $order->created_at->format('M-d-Y, h:i a') }}
                                </td>
                                <td>
                                    <span class="badge badge-pill badge-soft-{{ $order->status == 'processing' ? 'info' : 'success' }} font-size-12">{{ $order->status }}</span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target="#myOrder{{ $order->id }}">
                                        View Details
                                    </button>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                    @foreach ($orders as $data)
                        @include('admin.orders.modal')
                    @endforeach

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


    @endsection


