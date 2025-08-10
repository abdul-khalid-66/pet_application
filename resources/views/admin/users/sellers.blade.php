<x-app-layout>
    @push('css')
    {{-- <style>
            .category-img {
                width: 60px;
                height: 60px;
                object-fit: cover;
                border-radius: 5px;
            }
        </style> --}}
    @endpush

    <x-slot name="page_title">All Sellers</x-slot>
    <x-slot name="page_button">
        <a href="{{ route('animals.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New User
        </a>
    </x-slot>
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table id="sellersTable" class="jquery_datatable_class table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('admin/assets/assets/img/avatar.png') }}"
                                    alt="{{ $user->name }}" class="img-circle img-size-32 mr-2"
                                    style="object-fit: cover;"
                                    onerror="this.onerror=null;this.src='{{ asset('admin/assets/assets/img/avatar.png') }}';">
                                <span>{{ $user->name }}</span>
                            </div>
                        </td>

                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? 'N/A' }}</td>
                        <td>
                            @php
                            $roleClass = [
                            'admin' => 'role-admin',
                            'seller' => 'role-seller',
                            'buyer' => 'role-buyer'
                            ][$user->role];
                            @endphp
                            <span class="user-role {{ $roleClass }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td>
                            <span
                                class="user-status {{ $user->is_verified ? 'status-verified' : 'status-unverified' }}">
                                {{ $user->is_verified ? 'Verified' : 'Unverified' }}
                            </span>
                        </td>


                        <td>
                            @if($user && $user->created_at)
                            {{ $user->created_at->format('d M Y') }}
                            @else
                            N/A
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group" aria-label="User actions">

                                {{-- View --}}
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-info"
                                    data-toggle="tooltip" data-bs-toggle="tooltip" data-placement="top"
                                    data-bs-placement="top" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning"
                                    data-toggle="tooltip" data-bs-toggle="tooltip" data-placement="top"
                                    data-bs-placement="top" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                {{-- Delete --}}
                                @if($user->id != Auth::id())
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
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