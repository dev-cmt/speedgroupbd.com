<!-- resources/views/continents/index.blade.php -->
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Continents List</h4>
                    @can('Continent create')
                    <a href="{{ route('continents.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i><span class="btn-icon-add"></span>Add New
                    </a>
                    @endcan
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Countries</th>
                                    <th>Created At</th>
                                    <th class="text-right pr-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($continents as $key => $continent)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $continent->name }}</td>
                                    <td>{{ $continent->slug }}</td>
                                    <td>{{ $continent->countries_count }}</td>
                                    <td>{{ $continent->created_at->format('d M, Y') }}</td>
                                    <td class="d-flex justify-content-end">
                                        @can('Continent edit')
                                        <a href="{{ route('continents.edit', $continent->id) }}" class="btn btn-success shadow btn-xs sharp mr-1">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        @endcan
                                        <a href="{{ route('continents.show', $continent->id) }}" class="btn btn-info shadow btn-xs sharp mr-1">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @can('Continent delete')
                                        <form action="{{ route('continents.destroy', $continent->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger shadow btn-xs sharp" onclick="return confirm('Are you sure?');" type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        @endcan
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
