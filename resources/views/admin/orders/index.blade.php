<x-app-layout>
    @push('css')
    @endpush
    <x-slot name="page_title">Orders List</x-slot>
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="ordersTable" class="jquery_datatable_class table table-bordered table-striped table-hover">
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
                            <span
                                class="badge 
                                            {{ $order->payment_status == 'paid' ? 'badge-success' : 
                                               ($order->payment_status == 'pending' ? 'badge-warning' : 'badge-danger') }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                            <small class="d-block">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</small>
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm"
                                    title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-primary btn-sm"
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
    @push('scripts')

    @endpush
</x-app-layout>