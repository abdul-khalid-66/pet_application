<x-app-layout>
    @push('css')

        <style>
            .animal-img {
                width: 60px;
                height: 60px;
                object-fit: cover;
                border-radius: 5px;
            }
            .status-badge {
                font-size: 0.8rem;
                padding: 5px 10px;
                border-radius: 20px;
            }
            .badge-available {
                background-color: #28a745;
                color: white;
            }
            .badge-sold {
                background-color: #dc3545;
                color: white;
            }
            .badge-not-for-sale {
                background-color: #6c757d;
                color: white;
            }
            .badge-expired {
                background-color: #ffc107;
                color: #212529;
            }
        </style>
    @endpush
    <x-slot name="title">Animlas List</x-slot>


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Animals List</h3>
                        <div class="card-tools">
                            <a href="{{ route('animals.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Add New Animal
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="animalsTable" class="table table-bordered table-striped table-hover">
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
                                                 alt="{{ $animal->name }}" 
                                                 class="animal-img">
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
                                            <a href="{{ route('animals.show', $animal->id) }}" 
                                               class="btn btn-info btn-sm" 
                                               title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('animals.edit', $animal->id) }}" 
                                               class="btn btn-primary btn-sm" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('animals.destroy', $animal->id) }}" 
                                                  method="POST" 
                                                  style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-danger btn-sm" 
                                                        title="Delete"
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
                $('#animalsTable').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "order": [[0, 'desc']],
                    "columnDefs": [
                        { "orderable": false, "targets": [1, 8] },
                        { "searchable": false, "targets": [1, 8] }
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>