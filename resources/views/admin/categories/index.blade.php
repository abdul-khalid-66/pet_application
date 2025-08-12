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
                        <td>
                            <div class="btn-group">
                                {{-- <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm"
                                    title="View">
                                    <i class="bi bi-eye"></i>
                                </a> --}}
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm"
                                    title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if($category->id != Auth::id())
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 3px 3px 0px" title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this Category?')">
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