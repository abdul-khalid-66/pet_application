<x-app-layout>
    <x-slot name="page_title">Group Sales</x-slot>
    <x-slot name="page_button">
        <a href="{{ route('group-sales.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Create Group Sale
        </a>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <table id="groupSalesTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Group Name</th>
                        <th>Seller</th>
                        <th>Animals Count</th>
                        <th>Total Price</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($groupSales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->group_name }}</td>
                        <td>{{ $sale->seller->name }}</td>
                        <td>{{ $sale->animal_count }}</td>
                        <td>{{ number_format($sale->total_price, 2) }}</td>
                        <td>{{ $sale->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('group-sales.show', $sale->id) }}" 
                                   class="btn btn-info btn-sm" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('group-sales.edit', $sale->id) }}" 
                                   class="btn btn-primary btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('group-sales.destroy', $sale->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                        onclick="return confirm('Are you sure? This will make all animals available again.')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>