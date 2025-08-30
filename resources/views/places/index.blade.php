<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Places List</h4>
                    <a href="{{ route('places.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Country</th>
                                    <th>Slug</th>
                                    <th>Created At</th>
                                    <th class="text-right pr-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($places as $key => $place)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @if($place->image)
                                            <img src="{{ asset('public/' . $place->image) }}" width="50" height="50" class="rounded">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:50px;height:50px;">
                                                <i class="fa fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $place->name }}</td>
                                    <td>{{ $place->country->name }}</td>
                                    <td>{{ $place->slug }}</td>
                                    <td>{{ $place->created_at->format('d M, Y') }}</td>
                                    <td class="d-flex justify-content-end">
                                        <a href="{{ route('places.edit', $place->id) }}" class="btn btn-success shadow btn-xs sharp mr-1">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="{{ route('places.show', $place->id) }}" class="btn btn-info shadow btn-xs sharp mr-1">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <form action="{{ route('places.destroy', $place->id) }}" method="post">
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
