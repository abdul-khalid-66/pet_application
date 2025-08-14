<x-app-layout>
    <x-slot name="page_title">Group Sale: {{ $groupSale->group_name }}</x-slot>

    <div class="card">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h4>Group Details</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Group Name</th>
                            <td>{{ $groupSale->group_name }}</td>
                        </tr>
                        <tr>
                            <th>Seller</th>
                            <td>{{ $groupSale->seller->name }}</td>
                        </tr>
                        <tr>
                            <th>Total Price</th>
                            <td>{{ number_format($groupSale->total_price, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Animals Count</th>
                            <td>{{ $groupSale->animal_count }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $groupSale->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h4>Description</h4>
                    <p>{{ $groupSale->description ?? 'No description available' }}</p>
                </div>
            </div>

            <h4>Animals in this Group</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groupSale->animals as $animal)
                        <tr>
                            <td>{{ $animal->id }}</td>
                            <td>
                                @if($animal->images->first())
                                <img src="{{ asset('backend/' . $animal->images->first()->image_path) }}" 
                                     alt="{{ $animal->name }}" width="60" class="img-thumbnail">
                                @else
                                <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>{{ $animal->name }}</td>
                            <td>{{ $animal->category->name }}</td>
                            <td>{{ number_format($animal->price, 2) }}</td>
                            <td>
                                <span class="badge badge-{{ $animal->status == 'available' ? 'success' : 'warning' }}">
                                    {{ ucfirst($animal->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>