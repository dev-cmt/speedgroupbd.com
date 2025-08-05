<x-app-layout>
    <div class="row">
        <div class="col-12 mb-4">
            @can('Event create')
                <button type="button" id="open_modal" class="btn btn-sm btn-secondary float-right"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Create New</button>
            @endcan
        </div>
    </div>
    <div class="row" id="content-section">
        @foreach ($data as $row)
            <div class="col-lg-4" id="col_{{ $row->id }}">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('past-committee-member.index', $row->id) }}" class="btn btn-sm btn-primary py-1"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Member</a>
                        <div>
                            <a href="#" class="btn btn-success shadow btn-xs sharp mr-1" id="data-show" data-id="{{ $row->id }}"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="btn btn-danger shadow btn-xs sharp mr-1" id="data-delete" data-id="{{ $row->id }}"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6>{{$row->title}} {{$row->duration}}</h6>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        @if($row->status == 0)
                        <span class="badge light badge-danger">
                            <i class="fa fa-circle text-danger mr-1"></i> Inactive
                        </span>
                        @elseif($row->status == 1)
                        <span class="badge light badge-success">
                            <i class="fa fa-circle text-success mr-1"></i> Active
                        </span>
                        @endif

                        <span class="badge light badge-success">SL: {{$row->index}}</span>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
    <!--=======//Modal Show Data//========-->
    <div class="modal fade" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form class="form-valide" data-action="{{ route('past-committee.store') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                    @csrf
                    <input type="hidden" name="id" id="set_id">
                    <div class="modal-body py-2">
                        <div class="row" id="main-row-data">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label">Title
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-8">
                                        <textarea name="title" id="title" rows="2" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label">Duration</label>
                                    <div class="col-md-8">
                                        <input type="text" name="duration" id="duration" class="form-control" placeholder="2000-2002" maxlength="9">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label">index</label>
                                    <div class="col-md-8">
                                        <input type="number" name="index" id="index" class="form-control" placeholder="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="status" class="col-md-4 col-form-label">Status</label>
                                    <div class="col-md-8">
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="remarks" class="col-md-4 col-form-label">Description</label>
                                    <div class="col-md-8">
                                        <textarea name="description" id="description" rows="2" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div> 
                        </div>

                    </div>
                    <div class="modal-footer" style="height:50px">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary submit_btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
    <script type="text/javascript">
        /*=======//Show Modal//=========*/
        $(document).on('click','#open_modal', function(){
            $("#set_id").val('');
            $("#title").val('BAFIITA Executive Committee MEMBER’S');
            $("#duration").val('2000-2002');

            $(".modal-title").html('Add New');
            $("#exampleModalCenter").modal('show');
        });
        /*=======//Save Data //=========*/
        $('#add-user-form').on('submit', function(event){
            event.preventDefault();
            var url = $(this).attr('data-action');
            $.ajax({
                url: url,
                method: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(response)
                {
                    swal("Success Message Title", "Well done, you pressed a button", "success");
                    $("#exampleModalCenter").modal('hide');
                    
                    var statusHtml = (response.status == 0) ? '<span class="badge light badge-danger"><i class="fa fa-circle text-danger mr-1"></i> Inactive</span>' : '<span class="badge light badge-success"><i class="fa fa-circle text-success mr-1"></i> Active</span>';
                    
                    var newRowHtml = `
                        <div class="col-lg-4" id="col_${response.id}">
                            <div class="card">
                                <div class="card-header">
                                    <a href="{{ route('event.create') }}" class="btn btn-sm btn-primary py-1"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Member</a>
                                    <div>
                                        <a href="#" class="btn btn-success shadow btn-xs sharp mr-1" id="data-show" data-id="${response.id}"><i class="fa fa-pencil"></i></a>
                                        <a href="#" class="btn btn-danger shadow btn-xs sharp mr-1" id="data-delete" data-id="${response.id}"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h6>${response.title} ${response.duration} </h6>
                                </div>
                                <div class="card-footer d-flex justify-content-between">${statusHtml} <span class="badge light badge-success">SL: ${response.index}</span></div>
                            </div>
                        </div>`;

                    if ($("#set_id").val()) { $("#col_" + response.id).replaceWith(newRowHtml); }
                    else { $("#content-section").prepend(newRowHtml); }
                },
                error: function (xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorHtml = '';
                    $.each(errors, function(key, value) {
                        errorHtml += `<li style="color:red">${value}</li>`;
                    });
                    Swal.fire({ icon: 'error', title: 'Error!', html: `<ul>${errorHtml}</ul>`, text: 'All input values are not null or empty.' });
                }
            });
        });

        // Function to format the date
        function formatDate(dateString) {
            var date = new Date(dateString);
            var options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString(undefined, options);
        }
        /*========//Edit Or View Data//=========*/
        $(document).on('click', '#data-show', function(){
            var id = $(this).data('id');
            $.ajax({
                url:'{{ route('past-committee.edit')}}',
                method:'GET',
                dataType:"JSON",
                data:{id:id},
                success:function(response){
                    $(".modal-title").html('Edit Data');

                    $("#set_id").val(response.id);
                    $("#title").val(response.title);
                    $("#duration").val(response.duration);
                    $("#index").val(response.index);
                    $("#description").val(response.description);

                    $("#status").empty();
                    var status = $("#status");
                    var row = '<option value="1" ' + (response.status == 1 ? 'selected' : '') + '>Active</option>';
                    row += '<option value="0" ' + (response.status == 0 ? 'selected' : '') + '>Inactive</option>';
                    status.append(row);

                    $("#exampleModalCenter").modal('show');
                },
                error: function(xhr, status, error) {
                    swal("Error!", "There are no details available for this item.", "error");
                }
            });
        });

        /*========//Delete Data//========*/
        $(document).on('click', '#data-delete', function(){
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    // Place your delete code here
                    var id = $(this).data('id');
                    $.ajax({
                        url:'{{ route('past-committee.delete')}}',
                        method:'GET',
                        dataType:"JSON",
                        data:{'id':id},
                        success:function(data){
                            swal("Success Message Title", "Well done, you pressed a button", "success");
                            $("#col_" + data.id).hide();
                        },
                        error:function(){
                            swal("Error!", "There are no details available for this item.", "error");
                        }
                    });
                } else {
                    // User clicked "No" button, do nothing
                    swal("Your data is safe!", {
                        icon: "success",
                    });
                }
            });
        });

    </script>
    @endpush
</x-app-layout>
