<x-app-layout>
    @push('css')

    @endpush

    <x-slot name="page_title">Animal Categories</x-slot>
    <x-slot name="page_button">
        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New Category
        </a>
    </x-slot>
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="categoriesTable" class="jquery_datatable_class table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Animals Count</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>
                            @if($category->image)
                            <img style="width: 80px;height: 50px" src="{{ asset('backend/' . $category->image) }}" alt="{{ $category->name }}"
                                class="category-img">
                            @else
                            <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->animals_count }}</td>
                        <td>{{ $category->created_at->format('d M Y') }}</td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group" aria-label="User actions">

                                {{-- View --}}
                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info"
                                    data-toggle="tooltip" data-bs-toggle="tooltip" data-placement="top"
                                    data-bs-placement="top" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning"
                                    data-toggle="tooltip" data-bs-toggle="tooltip" data-placement="top"
                                    data-bs-placement="top" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                {{-- Delete --}}
                                @if($category->id != Auth::id())
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this user?')"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" data-toggle="tooltip"
                                        data-bs-toggle="tooltip" data-placement="top" data-bs-placement="top"
                                        title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
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