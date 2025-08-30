<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Tour Packages List</h4>
                    <a href="{{ route('packages.create') }}" class="btn btn-sm btn-primary">
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
                                    <th>Title</th>
                                    <th>Place</th>
                                    <th>Price</th>
                                    <th>Duration</th>
                                    <th>Created At</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($packages as $key => $package)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if($package->image)
                                                <img src="{{ asset('public/' . $package->image) }}" width="60" class="rounded">
                                            @else
                                                <div class="bg-light text-center rounded" style="width:60px;height:60px;">
                                                    <i class="fa fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $package->title }}</td>
                                        <td>{{ $package->place->name }}</td>
                                        <td>{{ number_format($package->price, 2) }} BDT</td>
                                        <td>{{ $package->duration }}</td>
                                        <td>{{ $package->created_at->format('d M, Y') }}</td>
                                        <td class="d-flex justify-content-end">
                                            <a href="{{ route('packages.edit', $package->id) }}" class="btn btn-success btn-sm mr-1">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <form action="{{ route('packages.destroy', $package->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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
