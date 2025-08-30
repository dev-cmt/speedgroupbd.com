<!-- resources/views/packages/edit.blade.php -->
<x-app-layout>

    @push('style')
        <style>
            .image-container {position:relative;border:1px solid transparent;overflow:hidden;transition:0.3s;cursor:pointer;}
            .default-image {border-color:#845adf;box-shadow:0 0 15px #845adf8c;}
            .image-container:hover {transform:translateY(-5px);box-shadow:0 10px 20px rgba(0,0,0,0.1);}
            .img-thumbnail {width:100%;aspect-ratio:1/1;object-fit:cover;transition:0.3s;}
            .default-badge {position:absolute;top:10px;right:10px;background:#0d6efd;color:#fff;padding:3px 7px;border-radius:3px;font-size:10px;font-weight:bold;display:none;}
            .image-container.new .default-badge {display:block;background:#28a745;}
            .default-image .default-badge {display:block;}
            .form-check-input[type="radio"] {display:none;}
        </style>
    @endpush

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Edit Tour Package</h4>
                    <a href="{{ route('packages.index') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-reply"></i> Back
                    </a>
                </div>

                <div class="card-body">
                    <div class="form-validation">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <strong>Success!</strong> {{ session()->get('success') }}
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                        @endif

                        <form action="{{ route('packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-xl-6">
                                    <!-- Place -->
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-place">Place <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <select id="val-place" name="place_id" class="form-control @error('place_id') is-invalid @enderror">
                                                <option value="">Select Place</option>
                                                @foreach($places as $place)
                                                    <option value="{{ $place->id }}" {{ old('place_id', $package->place_id) == $place->id ? 'selected' : '' }}>
                                                        {{ $place->name }} ({{ $place->country->name }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('place_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Title -->
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-title">Title <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="text" id="val-title" name="title" class="form-control @error('title') is-invalid @enderror"
                                                placeholder="Enter package title" value="{{ old('title', $package->title) }}">
                                            @error('title')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Price -->
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-price">Price <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="number" step="0.01" id="val-price" name="price" class="form-control @error('price') is-invalid @enderror"
                                                placeholder="Enter price" value="{{ old('price', $package->price) }}">
                                            @error('price')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Sale Price -->
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-sale-price">Sale Price</label>
                                        <div class="col-lg-6">
                                            <input type="number" step="0.01" id="val-sale-price" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror"
                                                placeholder="Enter sale price (optional)" value="{{ old('sale_price', $package->sale_price) }}">
                                            @error('sale_price')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Duration -->
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-duration">Duration <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="text" id="val-duration" name="duration" class="form-control @error('duration') is-invalid @enderror"
                                                placeholder="e.g., 5 days" value="{{ old('duration', $package->duration) }}">
                                            @error('duration')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>

                                <!-- Right Column -->
                                <div class="col-xl-6">
                                    <!-- Max Persons -->
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-max-persons">Max Persons <span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                            <input type="number" id="val-max-persons" name="max_persons" class="form-control @error('max_persons') is-invalid @enderror"
                                                placeholder="e.g., 12" value="{{ old('max_persons', $package->max_persons) }}">
                                            @error('max_persons')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Review Count -->
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-review-count">Review Count</label>
                                        <div class="col-lg-6">
                                            <input type="number" id="val-review-count" name="review_count" class="form-control @error('review_count') is-invalid @enderror"
                                                placeholder="e.g., 1" value="{{ old('review_count', $package->review_count) }}">
                                            @error('review_count')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Rating -->
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-rating">Rating</label>
                                        <div class="col-lg-6">
                                            <input type="number" step="0.1" min="0" max="5" id="val-rating" name="rating" class="form-control @error('rating') is-invalid @enderror"
                                                placeholder="e.g., 5.0" value="{{ old('rating', $package->rating) }}">
                                            @error('rating')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Status Toggles -->
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Status</label>
                                        <div class="col-lg-6">
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="is-featured" name="is_featured" value="1" {{ old('is_featured', $package->is_featured) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is-featured">
                                                    Featured
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="is-bestseller" name="is_bestseller" value="1" {{ old('is_bestseller', $package->is_bestseller) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is-bestseller">
                                                    Bestseller
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <!-- Full Width Section -->
                                <div class="col-xl-12">
                                    <div class="row mt-2" id="images-container">
                                        @foreach($package->images as $i => $image)
                                            @php $isDefault = $image->is_default || (!$package->images->where('is_default',1)->count() && $i==0); @endphp
                                            <div class="col-md-1 col-sm-1 col-2 mb-3 image-wrapper">
                                                <div class="image-container {{ $isDefault ? 'default-image' : '' }}" data-radio="default_{{ $image->id }}">
                                                    <img src="{{ asset('public/'.$image->image_path) }}" class="img-thumbnail">
                                                    <div class="default-badge">Default</div>
                                                    <input type="radio" name="is_default" class="form-check-input" value="{{ $image->id }}" id="default_{{ $image->id }}" {{ $isDefault ? 'checked' : '' }}>
                                                </div>
                                                <button type="button" class="delete-image btn btn-danger-transparent p-0 mt-1" data-imageid="{{ $image->id }}" style="width:100%;height:22px;border-radius:0"><i class="flaticon-381-multiply-1"></i></button>
                                            </div>
                                        @endforeach

                                        <!-- Add Image Card -->
                                        <div class="col-md-1 col-sm-1 col-2 mb-3">
                                            <label for="images" class="image-container d-flex flex-column align-items-center justify-content-center position-relative" style="cursor:pointer; min-height:100%; border:2px dashed #ced4da;">
                                                <i class="flaticon-381-add-1 text-secondary fs-2"></i>
                                                <span class="text-secondary fs-6 m-1">Add Image</span>
                                                <span class="selected-count position-absolute top-0 end-0 p-1 text-primary fs-7"></span>
                                                <input type="file" id="images" name="images[]" multiple accept="image/*" class="d-none">
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="col-xl-12">
                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label" for="description">Description</label>
                                        <div class="col-lg-12">
                                            <textarea id="description" name="description">{{ old('description', $package->description) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- 🚀 Itinerary Section -->
                                <div class="col-xl-12">
                                    <hr>
                                    <h4>Tour Plan (Itineraries)</h4>
                                    <div id="itinerary-wrapper">
                                        @foreach($package->itineraries as $index => $itinerary)
                                            <div class="border p-3 mb-3 itinerary-item position-relative">
                                                <button type="button" class="btn btn-sm btn-danger remove-itinerary"><i class="fa fa-times"></i></button>
                                                <label>Day Number</label>
                                                <input type="number" name="itineraries[{{ $index }}][day_number]" class="form-control mb-2" value="{{ old('itineraries.'.$index.'.day_number', $itinerary->day_number) }}">
                                                
                                                <label>Title</label>
                                                <input type="text" name="itineraries[{{ $index }}][title]" class="form-control mb-2" placeholder="Arrive in Zürich" value="{{ old('itineraries.'.$index.'.title', $itinerary->title) }}">

                                                <label>Description</label>
                                                <textarea name="itineraries[{{ $index }}][description]" class="form-control mb-2" placeholder="Enter details">{{ old('itineraries.'.$index.'.description', $itinerary->description) }}</textarea>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-sm btn-secondary" id="add-itinerary">+ Add Day</button>
                                </div>

                                <!-- Submit -->
                                <div class="col-xl-6 ml-auto">
                                    <button type="submit" class="btn btn-primary">Update Package</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @push('script')
    <!-- Include Editor -->
    <script src="{{asset('public/backend')}}/tinymce/tinymce.min.js"></script>

    <script>
        tinymce.init({
            selector: 'textarea#description',
            height: 300,
            plugins:[
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media', 
                'table', 'emoticons', 'template', 'codesample'
            ],
            toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify |' + 
            'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
            'forecolor backcolor emoticons',
            menu: {
                favs: {title: 'Menu', items: 'code visualaid | searchreplace | emoticons'}
            },
            menubar: 'favs file edit view insert format tools table',
            content_style: 'body{font-family:Helvetica,Arial,sans-serif; font-size:16px}'
        });
    </script>

    <script>
        $(function(){
            // Delete Image => Property Image
            $(".delete-image").click(function () {
                if (!confirm("Are you sure you want to delete this image?")) return;

                let parentCol = $(this).closest(".col-md-1");
                let imageId = $(this).data("imageid");

                $.ajax({
                    url: "{{ url('packages/images') }}/" + imageId,
                    type: "DELETE",
                    data: { _token: "{{ csrf_token() }}" },
                    success: () => parentCol.remove(),
                    error: () => alert("Failed to delete image.")
                });
            });
        });
    </script>

    <script>
        $(function(){
            const $container = $('#images-container');
            // Set Default
            const setDefault = $el => {
                $container.find('.image-container').removeClass('default-image');
                $el.addClass('default-image').find('input[type="radio"]').prop('checked', true);
            };

            // Click images
            $container.on('click', '.image-container', e => {
                if($(e.target).closest('.delete-image, .remove-new').length) return;
                setDefault($(e.currentTarget));
            });

            // Add new images
            $('#images').on('change', function(){
                const files = Array.from(this.files);
                $(this).closest('.image-container').find('.selected-count').text(files.length ? files.length+' file'+(files.length>1?'s':'') : '');

                files.forEach(file => {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const $div = $(`
                            <div class="col-md-3 col-sm-4 col-6 mb-3 text-center image-wrapper">
                                <div class="image-container new ${$container.find('.image-wrapper').length===1?'default-image':''}">
                                    <img src="${e.target.result}" class="img-thumbnail">
                                    <div class="default-badge">New</div>
                                    <input type="radio" name="is_default" class="form-check-input" value="new_${Date.now()}" ${$container.find('.image-wrapper').length===1?'checked':''}>
                                    <button type="button" class="remove-new btn btn-danger-transparent rounded-0 p-0 mt-1" style="width:100%;height:22px"><i class="flaticon-381-multiply-1"></i></button>
                                </div>
                            </div>
                        `).insertBefore($container.children().last());

                        // Remove new image
                        $div.find('.remove-new').on('click', () => $div.remove());
                    };
                    reader.readAsDataURL(file);
                });
            });
        });
    </script>

    <script>
        // Itinerary Management
        let i = {{ count($package->itineraries) }};
        const updateItineraryIndices = () => {
            $('#itinerary-wrapper .itinerary-item').each(function(index) {
                const newIndex = index;
                $(this).find('[name^="itineraries["]').each(function() {
                    const oldName = $(this).attr('name');
                    const newName = oldName.replace(/\[\d+\]/, '[' + newIndex + ']');
                    $(this).attr('name', newName);
                });
                $(this).find('[name$="[day_number]"]').val(newIndex + 1);
            });
        };

        $('#add-itinerary').on('click', function () {
            const dayCount = $('#itinerary-wrapper .itinerary-item').length;
            let html = `
            <div class="border p-3 mb-3 itinerary-item position-relative">
                <button type="button" class="btn btn-sm btn-danger remove-itinerary"><i class="fa fa-times"></i></button>
                <label>Day Number</label>
                <input type="number" name="itineraries[${dayCount}][day_number]" class="form-control mb-2" value="${dayCount + 1}">

                <label>Title</label>
                <input type="text" name="itineraries[${dayCount}][title]" class="form-control mb-2" placeholder="Enter title">

                <label>Description</label>
                <textarea name="itineraries[${dayCount}][description]" class="form-control mb-2" placeholder="Enter details"></textarea>
            </div>
            `;
            $('#itinerary-wrapper').append(html);
            updateItineraryIndices();
        });

        $(document).on('click', '.remove-itinerary', function () {
            $(this).closest('.itinerary-item').remove();
            updateItineraryIndices(); // Re-index all remaining items
        });
    </script>

    @endpush

</x-app-layout>