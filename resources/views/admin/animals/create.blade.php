<x-app-layout>
    @push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/min/dropzone.min.css') }}">
    <style>
        .image-preview {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
        }

        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .remove-image {
            position: absolute;
            top: 0;
            right: 0;
            background: red;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            text-align: center;
            line-height: 20px;
            cursor: pointer;
        }

        .image-wrapper {
            position: relative;
            margin-right: 10px;
            margin-bottom: 10px;
        }
    </style>
    @endpush

    <x-slot name="page_title">
        {{ isset($animal) ? 'Edit Animal' : 'Add New Animal' }}
    </x-slot>
    <x-slot name="page_button">
        <a href="{{ route('animals.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow"></i> Back
        </a>
    </x-slot>

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ isset($animal) ? route('animals.update', $animal->id) : route('animals.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($animal))
                @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Animal Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $animal->name ?? '') }}" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category_id">Category *</label>
                            <select class="form-control select2 @error('category_id') is-invalid @enderror"
                                id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $animal->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="seller_id">Seller *</label>
                            <select class="form-control select2 @error('seller_id') is-invalid @enderror" id="seller_id"
                                name="seller_id" required>
                                <option value="">Select Seller</option>
                                @foreach($sellers as $seller)
                                <option value="{{ $seller->id }}"
                                    {{ old('seller_id', $animal->seller_id ?? '') == $seller->id ? 'selected' : '' }}>
                                    {{ $seller->name }} ({{ $seller->email }})
                                </option>
                                @endforeach
                            </select>
                            @error('seller_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Price (PKR) *</label>
                            <input type="number" step="0.01" min="0"
                                class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                                value="{{ old('price', $animal->price ?? '') }}" required>
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sale_type">Sale Type *</label>
                            <select class="form-control @error('sale_type') is-invalid @enderror" id="sale_type"
                                name="sale_type" required>
                                <option value="fixed"
                                    {{ old('sale_type', $animal->sale_type ?? '') == 'fixed' ? 'selected' : '' }}>Fixed
                                    Price</option>
                                <option value="auction"
                                    {{ old('sale_type', $animal->sale_type ?? '') == 'auction' ? 'selected' : '' }}>
                                    Auction</option>
                                <option value="group"
                                    {{ old('sale_type', $animal->sale_type ?? '') == 'group' ? 'selected' : '' }}>Group
                                    Sale</option>
                            </select>
                            @error('sale_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="age">Age (months) *</label>
                            <input type="number" min="0" class="form-control @error('age') is-invalid @enderror"
                                id="age" name="age" value="{{ old('age', $animal->age ?? '') }}" required>
                            @error('age')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                id="date_of_birth" name="date_of_birth"
                                value="{{ old('date_of_birth', isset($animal->date_of_birth) ? $animal->date_of_birth->format('Y-m-d') : '') }}">
                            @error('date_of_birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender *</label>
                            <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender"
                                required>
                                <option value="male"
                                    {{ old('gender', $animal->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female"
                                    {{ old('gender', $animal->gender ?? '') == 'female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="other"
                                    {{ old('gender', $animal->gender ?? '') == 'other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="weight">Weight (kg) *</label>
                            <input type="number" step="0.01" min="0"
                                class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight"
                                value="{{ old('weight', $animal->weight ?? '') }}" required>
                            @error('weight')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status *</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status"
                                required>
                                <option value="available"
                                    {{ old('status', $animal->status ?? '') == 'available' ? 'selected' : '' }}>
                                    Available</option>
                                <option value="sold"
                                    {{ old('status', $animal->status ?? '') == 'sold' ? 'selected' : '' }}>Sold</option>
                                <option value="not_for_sale"
                                    {{ old('status', $animal->status ?? '') == 'not_for_sale' ? 'selected' : '' }}>Not
                                    for Sale</option>
                                <option value="expired"
                                    {{ old('status', $animal->status ?? '') == 'expired' ? 'selected' : '' }}>Expired
                                </option>
                            </select>
                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="color">Color *</label>
                            <input type="text" class="form-control @error('color') is-invalid @enderror" id="color"
                                name="color" value="{{ old('color', $animal->color ?? '') }}" required>
                            @error('color')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="height">Height (cm)</label>
                            <input type="number" step="0.01" min="0"
                                class="form-control @error('height') is-invalid @enderror" id="height" name="height"
                                value="{{ old('height', $animal->height ?? '') }}">
                            @error('height')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="location">Location *</label>
                    <input type="text" class="form-control @error('location') is-invalid @enderror" id="location"
                        name="location" value="{{ old('location', $animal->location ?? '') }}" required>
                    @error('location')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="health_info">Health Information</label>
                    <textarea class="form-control @error('health_info') is-invalid @enderror" id="health_info"
                        name="health_info" rows="3">{{ old('health_info', $animal->health_info ?? '') }}</textarea>
                    @error('health_info')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="feed_details">Feed Details</label>
                    <textarea class="form-control @error('feed_details') is-invalid @enderror" id="feed_details"
                        name="feed_details" rows="3">{{ old('feed_details', $animal->feed_details ?? '') }}</textarea>
                    @error('feed_details')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="images">Images</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('images') is-invalid @enderror" id="images"
                            name="images[]" multiple>
                        <label class="custom-file-label" for="images">Choose images</label>
                        @error('images')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <small class="form-text text-muted">
                        Upload multiple images (max 5 images, max 2MB each)
                    </small>

                    @if(isset($animal) && $animal->images->count() > 0)
                    <div class="image-preview-container mt-3">
                        @foreach($animal->images as $image)
                        <div class="image-wrapper">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="image-preview"
                                alt="Animal Image" style="width: 20%; height: 100px; object-fit: cover;">
                            <span class="remove-image" onclick="removeImage({{ $image->id }}, this)">
                                ×
                            </span>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured"
                            value="1" {{ old('is_featured', $animal->is_featured ?? false) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_featured">Featured Animal</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($animal) ? 'Update Animal' : 'Add Animal' }}
                    </button>
                    <a href="{{ route('animals.index') }}" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    @push('scripts')
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
        <script>

            $(function () {
                // Initialize Select2 Elements
                $('.select2').select2();

                // Initialize bsCustomFileInput
                bsCustomFileInput.init();

                // Calculate age based on date of birth
                $('#date_of_birth').change(function() {
                    if ($(this).val()) {
                        const dob = new Date($(this).val());
                        const today = new Date();
                        let age = today.getFullYear() - dob.getFullYear();
                        const m = today.getMonth() - dob.getMonth();
                        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
                            age--;
                        }
                        $('#age').val(age * 12); // Convert years to months
                    }
                });
            });
            function removeImage(imageId, element) {
                if (confirm('Are you sure you want to remove this image?')) {
                    $.ajax({
                        url: '/admin/animal-images/' + imageId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                $(element).parent().remove();
                            }
                        }
                    });
                }
            }
        </script>
    @endpush
</x-app-layout>