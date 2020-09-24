@extends('admin.master')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
                <i class="material-icons">format_list_bulleted</i>
            </div>
            <h4 class="card-title">Categories</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="CategoryTable">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Name</th>
                            <th class="text-center">Number of Recipes</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="table_data">
                        @foreach ($categories as $category)
                        <tr class="categoryRow{{ $category->id }}">
                            <td class="text-center" id="id">{{ $loop->iteration }}</td>
                            <td name="{{ $category->name }}" id="name">{{ $category->name }}</td>
                            <td class="text-center">{{ $category->recipes->count() }}</td>
                            <td class="td-actions text-right">
                                <a type="button" rel="tooltip" class="btn btn-success btn-link"
                                    category_id="{{ $category->id }}" id="edit_category">
                                    <i class="material-icons">edit</i>
                                </a>
                                <a type="button" rel="tooltip" class="btn btn-danger btn-link delete-category"
                                    category_id="{{ $category->id }}">
                                    <i class="material-icons">close</i>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="row" style="margin-right: 0px;margin-left: 0;">
        <div class="col-md-6">
            <form id="createCategoryForm" id="TypeValidation" class="form-horizontal" novalidate="novalidate">
                @csrf
                <div class="card ">
                    <div class="card-header card-header-info card-header-text">
                        <div class="card-text">
                            <h4 class="card-title">Create Category</h4>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="row" style="padding-top: 10px;">
                            <label class="col-sm-2 col-form-label" style="color: black;margin-left: 45px;">Name</label>
                            <div class="col-sm-7">
                                <div class="form-group bmd-form-group">
                                    <input class="form-control" type="text" name="name" required="true"
                                        aria-required="true" value="{{ old('name') }}" id="name">
                                </div>
                                <label id="name_error" class="error" for="required"
                                    style="color: red;display: none"></label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-info" id="store_category">Create</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <form id="updateCategoryForm" id="TypeValidation" class="form-horizontal" novalidate="novalidate">
                @csrf
                @method('put')
                <div class="card ">
                    <div class="card-header card-header-warning card-header-text">
                        <div class="card-text">
                            <h4 class="card-title">Update Category</h4>
                        </div>
                    </div>
                    <div class="card-body " id="move_to_edit">
                        <div class="row" style="padding-top: 10px;">
                            <label class="col-sm-2 col-form-label" style="color: black;margin-left: 45px;">Name</label>
                            <div class="col-sm-7">
                                <div class="form-group bmd-form-group">
                                    <input class="form-control" type="text" name="name" aria-required="true"
                                        id="edit-name">
                                    <input class="form-control" type="text" name="id" id="edit-id"
                                        style="display: none">
                                </div>
                                <label id="update_name_error" class="error" for="required"
                                    style="color: red;display: none"></label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-warning" id="update_category">Update</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    var currentRow;
    $(document).on('click', '#store_category', function(e){
        e.preventDefault();
        var name = $("input[name='name']").val();

        var formData = new FormData($('#createCategoryForm')[0]);
        $('#name').text('');
        // get last id to dynamic id
        var iteration = $('#CategoryTable tr').last().find("td:eq(0)").text();
        iteration = parseInt( iteration, 10);
        iteration = iteration + 1;

        $.ajax({
            type:'post',
            url: "{{ route('category.store') }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data){
                if(data.status){
                    // clear name input
                    $("input[name='name']").val('');
                    $('#name_error').css({display:'none'});
                    // notify
                    $.notify({
                    icon: 'done',
                    message: data.msg 
                    },{
                        type: 'success',
                    });
                }
                // insert data at table
                if(data.category){
                    var html =  '<tr class="categoryRow' + data.category.id + '">';
                        html +=     '<td class="text-center" id="id">' + iteration + '</td>';
                        html +=     '<td>'+data.category.name+'</td>';
                        html +=     '<td class="text-center">0</td>';
                        html +=     '<td class="td-actions text-right">';
                        html +=         '<a type="button" rel="tooltip" class="btn btn-success btn-link" category_id="'+data.category.id+'" id="edit_category" >';
                        html +=             '<i class="material-icons" style="margin-right: 4px;">edit</i>';
                        html +=         '</a>';
                        html +=         '<a type="button" rel="tooltip" class="btn btn-danger btn-link delete-category" category_id="'+data.category.id+'">';
                        html +=           '<i class="material-icons">close</i>';
                        html +=         '</a>';
                        html +=     '</td>';
                        html += '</tr>';

                        $('#table_data').append(html);
                       
                }

            },
            error: function(reject){
                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function(key, val){
                    $('#' + key + '_error').text(val[0]).show();
                });
            }
        });
    });
    $(document).on('click', '#edit_category', function(e){
        e.preventDefault();
        window.location.hash = '#move_to_edit';
        // set category name in update input
        currentRow = $(this).closest("tr");
        var category_id = $(this).attr('category_id');
        var name = currentRow.find("td:eq(1)").text(); 
        document.getElementById('edit-id').value = category_id;
        document.getElementById('edit-name').value = name;
    });
    $(document).on('click', '#update_category', function(e){
        e.preventDefault();
        // get form data
        var updateFormData = new FormData($('#updateCategoryForm')[0]);
        // post category to update
        $.ajax({
            type:'post',
            url: "{{ route('category.update', 0)}}",
            data: updateFormData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data){
                if(data.status){
                    // notify
                    $.notify({
                    icon: 'done',
                    message: data.msg 
                    },{
                        type: 'success',
                    });
                    // clear name input
                    $("input[name='name']").val('');
                    $('#update_name_error').css({display:'none'});
                    // set new value at column
                    currentRow.find("td:eq(1)").text(data.category.name);  
                }
            },error: function(reject){
                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function(key, val){
                    $('#update_' + key + '_error').text(val[0]).show();
                });
            }
        });
    });
    $(document).on('click', '.delete-category', function(e){
        e.preventDefault();
    
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            var category_id = $(this).attr('category_id');
            $.ajax({
                type:'delete',
                url: "{{ route('category.destroy', 0)}}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': category_id,
                },
                success: function(data){
                    if(data.status){
                        Swal.fire(
                            'Deleted!',
                            data.msg,
                            'success'
                        )
                    $('.categoryRow'+data.id).remove();
                    }else{
                        Swal.fire(
                            'Error!',
                            data.msg,
                            'error'
                        )
                    }
                },error: function(error){}
            });
        }else{
            Swal.fire(
                'Canceled!',
                'Delete Category Cancel',
                'success'
            )
        }
        })
    });
</script>
@endpush