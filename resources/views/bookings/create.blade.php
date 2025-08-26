<!-- resources/views/bookings/create.blade.php -->
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create New Booking</h4>
                    <a href="{{ route('bookings.index') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back
                    </a>
                </div>
                <div class="card-body">
                    <div class="form-validation">
                        <form class="form-valide" action="{{ route('bookings.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-user">User
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select id="val-user" class="form-control @error('user_id') is-invalid @enderror" name="user_id">
                                                <option value="">Select User</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }} ({{ $user->email }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-package">Tour Package
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select id="val-package" class="form-control @error('package_id') is-invalid @enderror" name="package_id">
                                                <option value="">Select Package</option>
                                                @foreach($tourPackages as $package)
                                                    <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}
                                                        data-price="{{ $package->price }}">
                                                        {{ $package->title }} - {{ $package->price }} BDT
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('package_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-start_date">Start Date
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" id="val-start_date" class="form-control @error('start_date') is-invalid @enderror"
                                                name="start_date" value="{{ old('start_date') }}">
                                            @error('start_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-persons">Persons
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="number" id="val-persons" class="form-control @error('persons') is-invalid @enderror"
                                                name="persons" min="1" value="{{ old('persons', 1) }}">
                                            @error('persons')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-total_cost">Total Cost
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="number" id="val-total_cost" class="form-control @error('total_cost') is-invalid @enderror"
                                                name="total_cost" readonly value="{{ old('total_cost', 0) }}">
                                            @error('total_cost')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="val-status">Status
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select id="val-status" class="form-control @error('status') is-invalid @enderror" name="status">
                                                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Confirmed" {{ old('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                            @error('status')
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const packageSelect = document.getElementById('val-package');
            const personsInput = document.getElementById('val-persons');
            const totalCostInput = document.getElementById('val-total_cost');

            function calculateTotalCost() {
                const selectedPackage = packageSelect.options[packageSelect.selectedIndex];
                const packagePrice = selectedPackage ? parseFloat(selectedPackage.getAttribute('data-price')) : 0;
                const persons = parseInt(personsInput.value) || 1;

                totalCostInput.value = packagePrice * persons;
            }

            packageSelect.addEventListener('change', calculateTotalCost);
            personsInput.addEventListener('input', calculateTotalCost);

            // Initial calculation
            calculateTotalCost();
        });
    </script>
</x-app-layout>
