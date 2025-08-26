<!-- resources/views/tour-packages/create.blade.php -->
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create New Tour Package</h4>
                    <a href="{{ route('tour-packages.index') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back
                    </a>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form class="form-valide" action="{{ route('tour-packages.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-place">Place
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select id="val-place" class="form-control @error('place_id') is-invalid @enderror" name="place_id">
                                                <option value="">Select Place</option>
                                                @foreach($places as $place)
                                                    <option value="{{ $place->id }}" {{ old('place_id') == $place->id ? 'selected' : '' }}>
                                                        {{ $place->name }} ({{ $place->country->name }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('place_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-title">Title
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" id="val-title" class="form-control @error('title') is-invalid @enderror"
                                                name="title" placeholder="Enter package title.." value="{{ old('title') }}">
                                            @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-price">Price
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="number" id="val-price" class="form-control @error('price') is-invalid @enderror"
                                                name="price" placeholder="Enter price.." value="{{ old('price') }}">
                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-duration">Duration
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" id="val-duration" class="form-control @error('duration') is-invalid @enderror"
                                                name="duration" placeholder="e.g., 3 Days" value="{{ old('duration') }}">
                                            @error('duration')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-image">Image</label>
                                        <div class="col-lg-6">
                                            <input type="file" id="val-image" class="form-control @error('image') is-invalid @enderror"
                                                name="image">
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-description">Description
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <textarea id="val-description" class="form-control @error('description') is-invalid @enderror"
                                                name="description" rows="3" placeholder="Enter package description..">{{ old('description') }}</textarea>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-8 ml-auto">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
