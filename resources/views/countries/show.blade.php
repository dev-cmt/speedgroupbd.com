<!-- resources/views/countries/show.blade.php -->
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Country Details</h4>
                    <a href="{{ route('countries.index') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label"><strong>Flag:</strong></label>
                                <div class="col-lg-8">
                                    @if($country->flag)
                                        <img src="{{ asset('storage/' . $country->flag) }}" alt="{{ $country->name }} flag" class="img-fluid" style="max-width: 100px; max-height: 60px;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 100px; height: 60px;">
                                            <i class="fa fa-globe text-muted fa-2x"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label"><strong>Name:</strong></label>
                                <div class="col-lg-8">
                                    <p class="form-control-plaintext">{{ $country->name }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label"><strong>Continent:</strong></label>
                                <div class="col-lg-8">
                                    <p class="form-control-plaintext">{{ $country->continent->name }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label"><strong>Slug:</strong></label>
                                <div class="col-lg-8">
                                    <p class="form-control-plaintext">{{ $country->slug }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label"><strong>Description:</strong></label>
                                <div class="col-lg-8">
                                    <p class="form-control-plaintext">{{ $country->description ?? 'No description available' }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label"><strong>Created At:</strong></label>
                                <div class="col-lg-8">
                                    <p class="form-control-plaintext">{{ $country->created_at->format('d M, Y h:i A') }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label"><strong>Updated At:</strong></label>
                                <div class="col-lg-8">
                                    <p class="form-control-plaintext">{{ $country->updated_at->format('d M, Y h:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h4 class="card-title">Places in {{ $country->name }}</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Tour Packages</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($country->places as $place)
                                        <tr>
                                            <td>
                                                @if($place->image)
                                                    <img src="{{ asset('storage/' . $place->image) }}" alt="{{ $place->name }}" width="50" height="50" style="object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                        <i class="fa fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $place->name }}</td>
                                            <td>{{ Str::limit($place->description, 50) }}</td>
                                            <td>{{ $place->tour_packages_count }}</td>
                                            <td>{{ $place->created_at->format('d M, Y') }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No places found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
