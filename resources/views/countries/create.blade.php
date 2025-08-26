<!-- resources/views/countries/create.blade.php -->
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create New Country</h4>
                    <a href="{{ route('countries.index') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back
                    </a>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form class="form-valide" action="{{ route('countries.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-continent">Continent
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select id="val-continent" class="form-control @error('continent_id') is-invalid @enderror"
                                                name="continent_id">
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
