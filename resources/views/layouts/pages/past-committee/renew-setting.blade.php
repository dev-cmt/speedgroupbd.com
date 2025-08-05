<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Renew Setting</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('renew-setting.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-danger">"This will be used during the renewal period. It will deactivate the active members, and after renewal, they will be considered members again."</p>
                                @error('past_committee_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <select name="past_committee_id" class="form-control">
                                    <option value="">Select Committee</option>
                                    @foreach ($data as $item)
                                        <option value="{{ $item->id }}">{{ $item->duration }}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success">Reset Current Member</button>
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Renew member list<span class="bg-blue-500 text-danger rounded px-1 text-xs py-0.5">{{ count($members) }}</span></h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>User Name</th>
                                    <th>Member Type</th>
                                    <th>Joining</th>
                                    <th>Departure</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($members->count() > 0)
                                @foreach ($members as $user)
                                <tr>
                                    <td><img class="img-fluid" src="{{asset('public')}}/images/profile/{{ $user->profile_photo_path }}" width="40" height="40" alt=""></td>
                                    <td>{{ $user->name }}<br><a href="mailto:<nowiki>{{ $user->email}}">{{ $user->email }}</a></td>
                                    <td>{{ $user->memberType->name ?? 'Null'}}</td>
                                    <td>{{ $user->join_date}}</td>
                                    <td>{{ $user->departure_date}}</td>
                                    <td>
                                        <div class="flex items-center">
                                            @if($user->status == '1')
                                            <span class="badge light badge-success">
                                                <i class="fa fa-circle text-success mr-1"></i> Active
                                            </span>
                                            @else
                                            <span class="badge light badge-danger">
                                                <i class="fa fa-circle text-danger mr-1"></i> Inactive
                                            </span>
                                            @endif
                                        </div>
                                    </td>												
                                </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>