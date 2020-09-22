@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-success card-header-text">
                <div class="card-text">
                    <h4 class="card-name">Update user</h4>
                </div>
            </div>
            <div class="card-body">
                <form id="editUserForm">
                    @csrf
                    @method('put')
                    <input type="text" value="{{ $user->id }}" name="id" style="display: none">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group bmd-form-group" style="margin-top: 52px;">
                                <label class="bmd-label-floating">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                <label id="name_error" class="error" for="required"
                                    style="display: none;color: red"></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group bmd-form-group" style="margin-top: 52px;">
                                <label class="bmd-label-floating">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                <label id="email_error" class="error" for="required"
                                    style="display: none;color: red"></label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer ml-auto mr-auto">
                <button id="update_user" type="submit" class="btn btn-success">Update user<div class="ripple-container">
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).on('click', '#update_user', function(e){
        e.preventDefault();
        var formData = new FormData($('#editUserForm')[0]);
        $.ajax({
            type:'post',
            url: "{{ route('user.update', $user->id) }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data){
                if(data.status){
                    // notify
                    $.notify({
                    icon: 'done',
                    message: data.message 
                    },{
                        type: 'success',
                    });
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
</script>
@endpush