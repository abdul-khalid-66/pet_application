<x-app-layout>
    <x-slot name="page_title">Create New Category</x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Category Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="parent_id">Parent Category</label>
                            <select class="form-control @error('parent_id') is-invalid @enderror" 
                                id="parent_id" name="parent_id">
                                <option value="">-- Select Parent Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                        {{ str_repeat('— ', $category->depth) }}{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Category Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                    id="image" name="image">
                                {{-- <label class="custom-file-label" for="image">Choose file</label> --}}
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="fas fa-save"></i> Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        // Update the custom file input label with the selected file name
        // document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        //     var fileName = document.getElementById("image").files[0].name;
        //     var nextSibling = e.target.nextElementSibling;
        //     nextSibling.innerText = fileName;
        // });
    </script>
    @endpush
</x-app-layout>