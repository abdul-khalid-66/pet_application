<x-app-layout>



@push('css')
    <style>
        .animal-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            border: 2px solid transparent;
        }
        .thumbnail.active {
            border-color: #007bff;
        }
        .info-label {
            font-weight: 600;
            color: #495057;
        }
        .info-value {
            margin-bottom: 15px;
        }
    </style>
@endpush

    <x-slot name="title">{{ $animal->name }}</x-slot>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Animal Details</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.animals.edit', $animal->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                @if($animal->images->count() > 0)
                                    <div class="text-center mb-3">
                                        <img id="mainImage" src="{{ asset('storage/' . $animal->images->first()->image_path) }}" 
                                             alt="{{ $animal->name }}" 
                                             class="animal-image img-fluid">
                                    </div>
                                    
                                    <div class="d-flex flex-wrap">
                                        @foreach($animal->images as $image)
                                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                                 alt="{{ $animal->name }}" 
                                                 class="thumbnail {{ $loop->first ? 'active' : '' }}"
                                                 onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}', this)">
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-info">No images available</div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h2>{{ $animal->name }}</h2>
                                
                                @php
                                    $statusClass = [
                                        'available' => 'badge-success',
                                        'sold' => 'badge-danger',
                                        'not_for_sale' => 'badge-secondary',
                                        'expired' => 'badge-warning'
                                    ][$animal->status];
                                @endphp
                                <span class="badge {{ $statusClass }} mb-3">
                                    {{ ucfirst(str_replace('_', ' ', $animal->status)) }}
                                </span>
                                
                                @if($animal->is_featured)
                                    <span class="badge badge-info mb-3">Featured</span>
                                @endif
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-label">Category</div>
                                        <div class="info-value">{{ $animal->category->name }}</div>
                                        
                                        <div class="info-label">Seller</div>
                                        <div class="info-value">
                                            <a href="{{ route('admin.users.show', $animal->seller_id) }}">
                                                {{ $animal->seller->name }}
                                            </a>
                                        </div>
                                        
                                        <div class="info-label">Price</div>
                                        <div class="info-value">{{ number_format($animal->price, 2) }} PKR</div>
                                        
                                        <div class="info-label">Sale Type</div>
                                        <div class="info-value">{{ ucfirst($animal->sale_type) }}</div>
                                        
                                        <div class="info-label">Age</div>
                                        <div class="info-value">
                                            {{ $animal->age }} months
                                            @if($animal->date_of_birth)
                                                (Born on {{ $animal->date_of_birth->format('d M Y') }})
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-label">Gender</div>
                                        <div class="info-value">{{ ucfirst($animal->gender) }}</div>
                                        
                                        <div class="info-label">Color</div>
                                        <div class="info-value">{{ $animal->color }}</div>
                                        
                                        <div class="info-label">Weight</div>
                                        <div class="info-value">{{ $animal->weight }} kg</div>
                                        
                                        <div class="info-label">Height</div>
                                        <div class="info-value">{{ $animal->height ?? 'N/A' }} cm</div>
                                        
                                        <div class="info-label">Location</div>
                                        <div class="info-value">{{ $animal->location }}</div>
                                    </div>
                                </div>
                                
                                <div class="info-label">Health Information</div>
                                <div class="info-value">
                                    {{ $animal->health_info ?? 'No health information provided' }}
                                </div>
                                
                                <div class="info-label">Feed Details</div>
                                <div class="info-value">
                                    {{ $animal->feed_details ?? 'No feed details provided' }}
                                </div>
                                
                                <div class="info-label">Created At</div>
                                <div class="info-value">
                                    {{ $animal->created_at->format('d M Y h:i A') }}
                                </div>
                                
                                <div class="info-label">Last Updated</div>
                                <div class="info-value">
                                    {{ $animal->updated_at->format('d M Y h:i A') }}
                                </div>
                            </div>
                        </div>
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
        function changeMainImage(src, element) {
            $('#mainImage').attr('src', src);
            $('.thumbnail').removeClass('active');
            $(element).addClass('active');
        }
    </script>
@endpush
</x-app-layout>