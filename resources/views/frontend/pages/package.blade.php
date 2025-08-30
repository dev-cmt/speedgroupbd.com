<x-frontend-layout>
@section('title', 'Tour Packages')

@section('breadcrumb')
    <section class="breadcumb-section">
        <div class="tf-container">
            <div class="row">
                <div class="col-lg-12 center z-index1">
                    <h1 class="title">Archive Tour</h1>
                    <ul class="breadcumb-list flex-five">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span>Tour Packages</span></li>
                    </ul>
                    <img class="bcrumb-ab" src="{{ asset('public/images/pages/mask-bcrumb.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <!-- Archive Tour Section -->
    <section class="archieve-tour pt-5 pb-5">
        <div class="tf-container">
            <div class="listing-list-car-wrap listing-list-car-wrap-grid3">

                <!-- Filter + Sorting Form -->
                <form action="{{ route('page.package', $country ?? null) }}" method="GET" class="tf-my-listing mb-37">
                    <div class="row align-center">
                        <div class="col-sm-5">
                            <p class="showing">
                                Showing <span class="text-main">{{ $packages->count() }}</span> of {{ $packages->total() }} Results
                            </p>
                        </div>
                        <div class="col-sm-7 flex-six group-bar-wrap">
                            <div class="listing-all-wrap">
                                <div class="flex-three">

                                    <!-- Filter: Min & Max Price -->
                                    <div class="group-select-recently me-2">
                                        <input type="number" name="min_price" value="{{ request('min_price') }}"
                                               placeholder="Min Price" class="form-control" style="width:120px; height: 40px;">
                                    </div>
                                    <div class="group-select-recently me-2">
                                        <input type="number" name="max_price" value="{{ request('max_price') }}"
                                               placeholder="Max Price" class="form-control" style="width:120px; height: 40px;">
                                    </div>

                                    <!-- Sorting -->
                                    <div class="group-select-recently me-2">
                                        <select name="sort" class="form-select">
                                            <option value="">Sort By</option>
                                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low → High</option>
                                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High → Low</option>
                                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                        </select>
                                    </div>

                                    <!-- Submit -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-main" style="height: 40px">Apply</button>
                                        <a href="{{ route('page.package') }}" class="btn btn-outline-secondary ms-2">Reset</a>
                                    </div>

                                    <!-- View Options -->
                                    <div class="toolbar-list ms-3">
                                        <div class="form-group">
                                            <a class="btn-display-listing-list">
                                                <i class="icon-list"></i>
                                            </a>
                                        </div>
                                        <div class="form-group">
                                            <a class="btn-display-listing-grid active">
                                                <i class="icon-Group-1000001297"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Packages Grid -->
                @if($packages->count() > 0)
                    <div class="listing-list-car-grid mb-60">
                            @foreach($packages as $package)
                                <div class="box-sd">
                                    {{-- Package Partial --}}
                                    @include('frontend.partials.__package', ['package' => $package])
                                </div>
                            @endforeach
                    </div>
                @else
                    <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                        <span class="alert alert-info text-center">No tour packages found.</span>
                    </div>
                @endif

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $packages->withQueryString()->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </section>
    <!-- End Archive Tour -->
@endsection
</x-frontend-layout>
