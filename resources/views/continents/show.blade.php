<!-- resources/views/continents/show.blade.php -->
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Continent Details</h4>
                    <a href="{{ route('continents.index') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label"><strong>Name:</strong></label>
                                <div class="col-lg-8">
                                    <p class="form-control-plaintext">{{ $continent->name }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label"><strong>Slug:</strong></label>
                                <div class="col-lg-8">
                                    <p class="form-control-plaintext">{{ $continent->slug }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label"><strong>Created At:</strong></label>
                                <div class="col-lg-8">
                                    <p class="form-control-plaintext">{{ $continent->created_at->format('d M, Y h:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h4 class="card-title">Countries in {{ $continent->name }}</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Places</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($continent->countries as $country)
                                        <tr>
                                            <td>{{ $country->name }}</td>
                                            <td>{{ $country->slug }}</td>
                                            <td>{{ $country->places_count }}</td>
                                            <td>{{ $country->created_at->format('d M, Y') }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No countries found</td>
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
