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
    <x-slot name="title">{{ isset($animal) ? 'Edit Animal' : 'Add New Animal' }}</x-slot>

    
    <!-- /.container-fluid -->


    @push('js')
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
</x-app-layout>