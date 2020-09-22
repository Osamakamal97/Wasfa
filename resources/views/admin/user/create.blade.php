@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-success card-header-text">
                <div class="card-text">
                    <h4 class="card-title">Create recipe</h4>
                </div>
            </div>
            <div class="card-body">
                <form id="createUserForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group bmd-form-group" style="margin-top: 52px;">
                                <label class="bmd-label-floating">Name</label>
                                <input type="text" class="form-control" name="name">
                                <label id="name_error" class="error" for="required"
                                    style="display: none;color: red"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group bmd-form-group" style="margin-top: 52px;">
                                <label class="bmd-label-floating">Email</label>
                                <input type="text" class="form-control" name="email">
                                <label id="email_error" class="error" for="required"
                                    style="display: none;color: red"></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group bmd-form-group" style="margin-top: 52px;">
                                <label class="bmd-label-floating">Password</label>
                                <input type="text" class="form-control" name="password">
                                <label id="password_error" class="error" for="required"
                                    style="display: none;color: red"></label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer ml-auto mr-auto">
                <button id="store_user" type="submit" class="btn btn-success">Create Recipe<div
                        class="ripple-container">
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).on('click', '#store_user', function(e){
        e.preventDefault();
        var formData = new FormData($('#createUserForm')[0]);

        $.ajax({
            type:'post',
            url: "{{ route('user.store') }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data){
                if(data.status){
                    // clear name input
                    $("input[name='name']").val('');
                    $('#name_error').css({display:'none'});
                    $("input[name='email']").val('');
                    $('#email_error').css({display:'none'});
                    $("input[name='password']").val('');
                    $('#password_error').css({display:'none'});
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