<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Member Approve List</h4>
                </div>

                <div class="card-body" id="reload">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Contact Info.</th>
                                    <th>Documents</th>
                                    <th>View Info.</th>
                                    <th>Transaction</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td><img class="img-fluid" src="{{ asset('public/images/profile/' . $row->profile_photo_path) }}" width="40" height="40" alt=""></td>
                                    <td>
                                        <strong>Name: </strong>{{ $row->name }} <br>
                                        <strong>Email: </strong><a href="mailto:{{ $row->email }}">{{ $row->email }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('member-document.downloadZipFile', $row->id) }}" target="_blank" class="btn btn-sm btn-secondary p-1 px-2 m-1">
                                            <i class="flaticon-381-download"></i><span class="btn-icon-add"></span> Zip
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('profile_show', $row->id) }}" target="_blank" class="btn btn-sm btn-info p-1 px-2 m-1">
                                            <i class="flaticon-381-view"></i><span class="btn-icon-add"></span> View
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('transaction-registation-approve.index') }}">
                                            @if ($row->paymentDetails && $row->paymentDetails->status == 1)
                                            <span class="badge light badge-success">
                                                <i class="fa fa-circle text-success mr-1"></i> Payment
                                            </span>
                                            @else
                                            <span class="badge light badge-danger"><i class="fa fa-circle text-danger mr-1"></i> No-Payment</span>
                                            @endif
                                        </a>
                                    </td>
                                    @can('Member approved')
                                        <td class="text-right">
                                            @if ($row->status == 0 && $status == 4 || $row->status == 4 && $status == 3 || $row->status == 3 && $status == 1)
                                            <div class="d-flex justify-content-end align-items-center">
                                                @if ($row->status != 3)
                                                <form action="{{ route('member-approve.update', $row->id) }}" method="post">
                                                    <input type="hidden" name="status" value="{{$status}}">
                                                    <button class="btn btn-sm btn-success p-1 mr-1">Approve</button>
                                                    @csrf
                                                    @method('PATCH')
                                                </form>
                                                @else
                                                <!-- Approve trigger modal -->
                                                <button type="button" class="btn btn-sm btn-success p-1 mr-1" data-toggle="modal" data-target="#exampleModalCenterApprove{{$key}}">Approve</button>
                                                @endif
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalCenterApprove{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle{{$key}}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Member Code </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body pt-0">
                                                                <form action="{{ route('member-approve.update', $row->id) }}" method="post">
                                                                    <input type="hidden" name="status" value="{{$status}}">
                                                                    <input type="text" class="form-control" name="member_code" placeholder="Type Membership No." value="{{$row->member_code}}">
                                                                    <button class="btn btn-sm btn-success float-right mt-2">Submit</button>
                                                                    @csrf
                                                                    @method('PATCH')
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--End-->

                                                <!-- Canceled trigger modal -->
                                                <button type="button" class="btn btn-sm btn-danger p-1 mr-1" data-toggle="modal" data-target="#exampleModalCenter{{$key}}">Canceled</button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalCenter{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle{{$key}}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Cancelled Reason </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('member-approve.cancel', $row->id) }}" method="post">
                                                                    <textarea name="description" class="form-control" rows="2" placeholder="Type cancelled reason !"></textarea>
                                                                    <button class="btn btn-sm btn-success float-right mt-2">Submit</button>
                                                                    @csrf
                                                                    @method('PATCH')
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--End-->
                                            </div>
                                            @elseif ($row->status == 1)
                                            <span class="badge light badge-success">
                                                <i class="fa fa-circle text-success mr-1"></i> Approved Successfully
                                            </span>
                                            @elseif ($row->status == 2)
                                            <span class="badge light badge-danger">
                                                <i class="fa fa-circle text-danger mr-1"></i> Cancelled Successfully
                                            </span>
                                            @else
                                            <span class="badge light badge-warning">
                                                <i class="fa fa-circle text-warning mr-1"></i> Processing
                                            </span>
                                            @endif
                                        </td>
                                        </form>
                                    </tr>
                                    @endcan
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                

            </div>
        </div>
    </div>

    @can('Member approve record')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Member Approve History</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example4" class="display " style="min-width: 845px">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Contact Info.</th>
                                <th>Member Info</th>
                                <th>Approve By</th>
                                <th>View Info.</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($record as $key => $row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td><img class="img-fluid" src="{{ asset('public/images/profile/' . $row->profile_photo_path) }}" width="40" height="40" alt=""></td>
                                    <td>
                                        <strong>Name: </strong>{{ $row->name }} <br>
                                        <strong>Email: </strong><a href="mailto:{{ $row->email }}">{{ $row->email }}</a>
                                    </td>
                                    <td>
                                        <strong>Member Code: </strong>{{ $row->member_code ?? 'null' }} <br>
                                        <strong>Member Type: </strong>{{$row->memberType->name ?? 'null'}}</a>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-secondary p-1 px-2">{{ $row->parentUser->name ?? 'null' }}</button>
                                    </td>
                                    <td>
                                        <a href="{{ route('profile_show', $row->id) }}" target="_blank" class="btn btn-sm btn-info p-1 px-2 m-1">
                                            <i class="flaticon-381-view"></i><span class="btn-icon-add"></span> View
                                        </a>
                                    </td>
                                    <td class="text-right">
                                        @if ($row->status == 1)
                                        <a href="{{ route('member-document.downloadZipFile', $row->id) }}" target="_blank" class="btn btn-sm btn-secondary p-1 px-2 m-1">
                                            <i class="flaticon-381-download"></i><span class="btn-icon-add"></span> Zip
                                        </a>
                                        <a href="{{ route('member-information.download', $row->id) }}" target="_blank" class="btn btn-sm btn-success p-1 px-2 m-1">
                                            <i class="flaticon-381-print-1"></i><span class="btn-icon-add"></span> Print
                                        </a>
                                        @elseif ($row->status == 2)
                                        <span class="badge light badge-danger">
                                            <i class="fa fa-circle text-danger mr-1"></i> Canceled
                                        </span>
                                        @endif
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
    @endcan
</x-app-layout>
