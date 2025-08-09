<x-app-layout>
@push('css')
    <style>
        .order-status {
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 20px;
        }
        .status-pending {
            background-color: #ffc107;
            color: #212529;
        }
        .status-shipped {
            background-color: #17a2b8;
            color: white;
        }
        .status-delivered {
            background-color: #28a745;
            color: white;
        }
        .status-cancelled {
            background-color: #dc3545;
            color: white;
        }
        .status-returned {
            background-color: #6c757d;
            color: white;
        }
    </style>
@endpush
    <x-slot name="title">Orders Management</x-slot>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Orders List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="ordersTable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Buyer</th>
                                    <th>Seller</th>
                                    <th>Items</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->buyer->name }}</td>
                                    <td>{{ $order->seller->name }}</td>
                                    <td>{{ $order->items->count() }}</td>
                                    <td>{{ number_format($order->total_amount, 2) }} PKR</td>
                                    <td>
                                        @php
                                            $statusClass = [
                                                'pending' => 'status-pending',
                                                'shipped' => 'status-shipped',
                                                'delivered' => 'status-delivered',
                                                'cancelled' => 'status-cancelled',
                                                'returned' => 'status-returned'
                                            ][$order->status];
                                        @endphp
                                        <span class="order-status {{ $statusClass }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge 
                                            {{ $order->payment_status == 'paid' ? 'badge-success' : 
                                               ($order->payment_status == 'pending' ? 'badge-warning' : 'badge-danger') }}">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                        <small class="d-block">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</small>
                                    </td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.orders.show', $order->id) }}" 
                                               class="btn btn-info btn-sm" 
                                               title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.orders.edit', $order->id) }}" 
                                               class="btn btn-primary btn-sm" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

@push('js')
    <script>
        $(function () {
            $('#ordersTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "order": [[0, 'desc']],
                "columnDefs": [
                    { "orderable": false, "targets": [8] },
                    { "searchable": false, "targets": [8] }
                ]
            });
        });
    </script>
@endpush
</x-app-layout>