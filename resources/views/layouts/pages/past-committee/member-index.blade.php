<x-app-layout>

    <div class="row">
        <div class="col-12 d-flex justify-content-between">
            <h4 class="card-title">{{$item->title}} {{$item->duration}}</h4>
            <button type="button" id="open_modal" class="btn btn-sm btn-secondary float-right"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Create New</button>
        </div>
    </div>

    <div class="row" id="content-section">
        @foreach ($data as $row)
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 items" id="col_{{ $row->id }}">
            <div class="card contact-bx item-content">
                <div class="card-header border-0">
                    <div class="action-dropdown">
                        <div class="dropdown">
                            <a href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item edit" href="javascript:void(0);" id="data-show" data-id="{{ $row->id }}">Edit</a>
                                <a class="dropdown-item delete" href="javascript:void(0);" id="data-delete" data-id="{{ $row->id }}">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body user-profile">
                    <div class="image-bx">
                        <img src="{{asset('public')}}/{{$row->image_path}}" class="rounded-circle" alt="">
                        <span class="active text-white">{{$row->index}}</span>
                    </div>
                    <div class="media-body user-meta-info">
                        <h6 class="fs-20 font-w500 my-1">{{$row->name}} </h6>
                        <p class="fs-16 mb-1">DESIG: <span class="text-danger">{{$row->designation}}</span></p>
                        <a href="{{$row->rep_url}}" target="_blank" class="fs-16 mb-2">REP: <span class="text-info">{{$row->represent}}</span></a>
                    </div>
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
                <form class="form-valide" data-action="{{ route('past-committee-member.store') }}" method="POST" enctype="multipart/form-data" id="add-user-form">
                    @csrf
                    <input type="hidden" name="id" id="set_id">
                    <input type="hidden" name="past_committee_id" value="{{$item->id}}">
                    <div class="modal-body py-2">
                        <div class="row" id="main-row-data">
                            <div class="col-md-12">
                                <div class="image-placeholder">
                                    <div class="avatar-edit">
                                        <input type="file" name="image" id="imageUpload" accept=".png, .jpg, .jpeg">
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url('{{asset('public/images')}}/logo.png');"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Name</label>
                                    <div class="col-md-8">
                                        <input type="text" name="name" id="name" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Designation</label>
                                    <div class="col-md-8">
                                        <input type="text" name="designation" id="designation" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Represent Company</label>
                                    <div class="col-md-8">
                                        <input type="text" name="represent" id="represent" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Rp. Company URL</label>
                                    <div class="col-md-8">
                                        <input type="text" name="rep_url" id="rep_url" class="form-control" value="">
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
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Index</label>
                                    <input type="text" name="index" id="index" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
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
            $("#name").val('');
            $("#designation").val('');
            $("#represent").val('');
            $("#rep_url").val('');
            $("#description").val('');
            $("#index").val('');

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
                success: function(response) {
                    swal("Success Message Title", "Well done, you pressed a button", "success");
                    $("#exampleModalCenter").modal('hide');

                    var imagePath = "{{ asset('public') }}/" + response.image_path;
                    var itemId = `#col_${response.id}`;

                    var item = `<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 items" id="col_${response.id}">
                                    <div class="card contact-bx item-content">
                                        <div class="card-header border-0">
                                            <div class="action-dropdown">
                                                <div class="dropdown">
                                                    <a href="javascript:void(0);" data-toggle="dropdown" aria-expanded="false">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item edit" href="javascript:void(0);" id="data-show" data-id="${response.id}">Edit</a>
                                                        <a class="dropdown-item delete" id="data-delete" data-id="${response.id}" href="javascript:void(0);">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body user-profile">
                                            <div class="image-bx">
                                                <img src="${imagePath}" class="rounded-circle" alt="">
                                                <span class="active text-white">${response.index}</span>
                                            </div>
                                            <div class="media-body user-meta-info">
                                                <h6 class="fs-20 font-w500 my-1">${response.name}</h6>
                                                <p class="fs-16 mb-1">DESIG: <span class="text-danger">${response.designation}</span></p>
                                                <a href="${response.rep_url}" target="_blank" class="fs-16 mb-2">REP: <span class="text-info">${response.represent}</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;

                    // Check if the item already exists
                    if ($("#set_id").val() !== null && $("#set_id").val() !== "") {
                        // Replace the item if #set_id has a value
                        $(itemId).replaceWith(item);
                    } else {
                        // Append the item if #set_id does not have a value
                        $("#content-section").append(item);
                    }
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

        /*========//Edit Or View Data//=========*/
        $(document).on('click', '#data-show', function(){
            var id = $(this).data('id');
            $.ajax({
                url:'{{ route('past-committee-member.edit')}}',
                method:'GET',
                dataType:"JSON",
                data:{id:id},
                success:function(response){
                    $("#set_id").val(response.id);
                    $("#name").val(response.name);
                    $("#designation").val(response.designation);
                    $("#represent").val(response.represent);
                    $("#rep_url").val(response.represent_url);
                    $("#description").val(response.id);
                    $("#index").val(response.index);

                    var imagePath = "{{ asset('public') }}/" + response.image_path;
                    $('#imagePreview').css('background-image', 'url(' + imagePath + ')');
                    
                    // $("#imageUpload").attr("src", imagePath);

                    $(".modal-title").html('Edit Past Member');
                    $("#exampleModalCenter").modal('show');
                },
                error: function(xhr, status, error) {
                    swal("Error!", "There are no details available for this item.", "error");
                }
            });
        });

        /*========//Delete Data//========*/
        $(document).on('click', '#data-delete', function() {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var id = $(this).data('id');
                    $.ajax({
                        url: '{{ route('past-committee-member.delete') }}',
                        method: 'DELETE', // Change to DELETE
                        dataType: "JSON",
                        data: {
                            '_token': '{{ csrf_token() }}', // Add CSRF token for security
                            'id': id
                        },
                        success: function(response) {
                            swal("Success", "Past Member Delete successfully", "success");
                            var itemId = `#col_${id}`;
                            $(itemId).fadeOut();
                        },
                        error: function() {
                            swal("Error!", "There was a problem deleting the member.", "error");
                        }
                    });
                } else {
                    swal("Your data is safe!", {
                        icon: "success",
                    });
                }
            });
        });


    </script>

    <script>
        $(document).ready(function() {
            $('#imageUpload').on('change', function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Update background image of preview element
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                }
                // Read the selected file as a data URL
                reader.readAsDataURL(this.files[0]);
            });
        });

    </script>
    @endpush
</x-app-layout>
