<x-app-layout>
    <x-slot name="page_title">Create Group Sale</x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('group-sales.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="group_name">Group Name *</label>
                            <input type="text" class="form-control @error('group_name') is-invalid @enderror" 
                                   id="group_name" name="group_name" value="{{ old('group_name') }}" required>
                            @error('group_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="total_price">Total Price *</label>
                            <input type="number" step="0.01" class="form-control @error('total_price') is-invalid @enderror" 
                                   id="total_price" name="total_price" value="{{ old('total_price') }}" required>
                            @error('total_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="2">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Select Animals *</label>
                            @error('animal_ids')
                                <div class="text-danger mb-2">{{ $message }}</div>
                            @enderror
                            
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="50px">Select</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($animals as $animal)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="animal_ids[]" 
                                                       value="{{ $animal->id }}" 
                                                       @if(in_array($animal->id, old('animal_ids', []))) checked @endif>
                                            </td>
                                            <td>{{ $animal->id }}</td>
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
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Group Sale
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>