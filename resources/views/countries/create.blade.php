<!-- resources/views/countries/create.blade.php -->
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Add New Country</h4>
                    <a href="{{ route('countries.index') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-reply"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                    <polyline points="9 11 12 14 22 4"></polyline>
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                </svg>
                                <strong>Success!</strong> {{ session()->get('success') }}
                            </div>
                        @endif

                        <form class="form-valide" action="{{ route('countries.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-continent">Continent
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select id="val-continent" class="form-control @error('continent_id') is-invalid @enderror" name="continent_id">
                                                <option value="">Select Continent</option>
                                                @foreach($continents as $continent)
                                                    <option value="{{ $continent->id }}" {{ old('continent_id') == $continent->id ? 'selected' : '' }}>
                                                        {{ $continent->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('continent_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-name">Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" id="val-name" class="form-control @error('name') is-invalid @enderror"
                                                name="name" placeholder="Enter country name.." value="{{ old('name') }}">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-flag">Flag Image</label>
                                        <div class="col-lg-6">
                                            <input type="file" id="val-flag" class="form-control @error('flag') is-invalid @enderror" name="flag">
                                            @error('flag')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-description">Description</label>
                                        <div class="col-lg-6">
                                            <textarea id="val-description" class="form-control @error('description') is-invalid @enderror"
                                                name="description" rows="3" placeholder="Enter country description..">{{ old('description') }}</textarea>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-8 ml-auto">
                                            <button type="submit" class="btn btn-primary">Save</button>
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

    <script>
        // Auto-generate slug from name if needed
        document.getElementById('val-name').addEventListener('input', function() {
            const name = this.value;
            const slug = name.toLowerCase()
                .trim()
                .replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // replace spaces with -
                .replace(/-+/g, '-'); // collapse dashes

            // If you have a hidden input for slug, you can set it here:
            // document.getElementById('val-slug').value = slug;
        });
    </script>
</x-app-layout>
