<!-- resources/views/continents/create.blade.php -->
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create New Continent</h4>
                    <a href="{{ route('continents.index') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back
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

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                    <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                </svg>
                                <strong>Error!</strong> Please check the form below for errors.
                            </div>
                        @endif

                        <form class="form-valide" action="{{ route('continents.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-name">Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" id="val-name" class="form-control @error('name') is-invalid @enderror"
                                                name="name" placeholder="Enter continent name.." value="{{ old('name') }}">
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
                                        <label class="col-lg-4 col-form-label" for="val-slug">Slug
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" id="val-slug" class="form-control @error('slug') is-invalid @enderror"
                                                name="slug" placeholder="Enter slug.." value="{{ old('slug') }}">
                                            @error('slug')
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
