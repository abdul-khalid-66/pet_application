<x-app-layout>
    <x-slot name="page_title">User Details: {{ $user->name }}</x-slot>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}" 
                             alt="Profile Image" class="img-fluid rounded-circle mb-3" 
                             style="width: 200px; height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3" 
                             style="width: 200px; height: 200px; margin: 0 auto;">
                            <span class="text-muted">No Image</span>
                        </div>
                    @endif
                    
                    <h4>{{ $user->name }}</h4>
                    <span class="badge badge-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'seller' ? 'primary' : 'success') }}">
                        {{ ucfirst($user->role) }}
                    </span>
                    
                    <div class="mt-3">
                        @if($user->is_verified)
                            <span class="badge badge-success">Verified</span>
                        @else
                            <span class="badge badge-warning">Not Verified</span>
                        @endif
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email Address</label>
                                <p class="form-control-plaintext">{{ $user->email }}</p>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <p class="form-control-plaintext">{{ $user->phone ?? 'N/A' }}</p>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <p class="form-control-plaintext">
                                    {{ $user->address ?? 'N/A' }}
                                    @if($user->city || $user->country)
                                        <br>
                                        {{ $user->city }}{{ $user->city && $user->country ? ', ' : '' }}{{ $user->country }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Created</label>
                                <p class="form-control-plaintext">
                                    {{ $user->created_at->format('M d, Y') }}<br>
                                    <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                                </p>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Updated</label>
                                <p class="form-control-plaintext">
                                    {{ $user->updated_at->format('M d, Y') }}<br>
                                    <small class="text-muted">{{ $user->updated_at->diffForHumans() }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary mr-2">
                            <i class="fas fa-edit"></i> Edit User
                        </a>
                        
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Are you sure you want to delete this user?')">
                                <i class="fas fa-trash"></i> Delete User
                            </button>
                        </form>
                        
                        <a href="{{ route('users.index') }}" class="btn btn-secondary float-right">
                            <i class="fas fa-arrow-left"></i> Back to Users
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>