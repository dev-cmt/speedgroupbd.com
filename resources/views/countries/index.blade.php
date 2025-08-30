<!-- resources/views/countries/index.blade.php -->
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Countries List</h4>
                    <a href="{{ route('countries.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i><span class="btn-icon-add"></span>Add New
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Flag</th>
                                    <th>Name</th>
                                    <th>Continent</th>
                                    <th>Slug</th>
                                    <th>Places</th>
                                    <th>Created At</th>
                                    <th class="text-right pr-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countries as $key => $country)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @if($country->flag)
                                            <img class="rounded-circle" src="{{ asset('public/' . $country->flag) }}" width="35" height="35" alt="{{ $country->name }} flag">
                                        @else
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                <i class="fa fa-globe text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $country->name }}</td>
                                    <td>{{ $country->continent->name }}</td>
                                    <td>{{ $country->slug }}</td>
                                    <td>{{ $country->places_count }}</td>
                                    <td>{{ $country->created_at->format('d M, Y') }}</td>
                                    <td class="d-flex justify-content-end">
                                        <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-success shadow btn-xs sharp mr-1">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('countries.show', $country->id) }}" class="btn btn-info shadow btn-xs sharp mr-1">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <form action="{{ route('countries.destroy', $country->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger shadow btn-xs sharp" onclick="return confirm('Are you sure?');" type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
