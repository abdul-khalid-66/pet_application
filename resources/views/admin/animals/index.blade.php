<x-app-layout>
    @push('css')

    @endpush

    <x-slot name="page_title">
        Animals List
    </x-slot>
    <x-slot name="page_button">
        <a href="{{ route('animals.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New Animal
        </a>
    </x-slot>

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="animalsTable" class="jquery_datatable_class table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Seller</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($animals as $animal)
                    <tr>
                        <td>{{ $animal->id }}</td>
                        <td>
                            @if($animal->images->count() > 0)
                            <img src="{{ asset('storage/' . $animal->images->first()->image_path) }}"
                                alt="{{ $animal->name }}" class="animal-img">
                            @else
                            <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td>{{ $animal->name }}</td>
                        <td>{{ $animal->category->name }}</td>
                        <td>{{ number_format($animal->price, 2) }} PKR</td>
                        <td>
                            @php
                            $statusClass = [
                            'available' => 'badge-available',
                            'sold' => 'badge-sold',
                            'not_for_sale' => 'badge-not-for-sale',
                            'expired' => 'badge-expired'
                            ][$animal->status];
                            @endphp
                            <span class="status-badge {{ $statusClass }}">
                                {{ ucfirst(str_replace('_', ' ', $animal->status)) }}
                            </span>
                        </td>
                        <td>{{ $animal->seller->name }}</td>
                        <td>{{ $animal->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('animals.show', $animal->id) }}" class="btn btn-info btn-sm"
                                    title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('animals.edit', $animal->id) }}" class="btn btn-primary btn-sm"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('animals.destroy', $animal->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this animal?')">
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
        <!-- /.card-body -->
    </div>
    @push('scripts')
  
    @endpush
</x-app-layout>