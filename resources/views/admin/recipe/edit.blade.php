@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-success card-header-text">
                <div class="card-text">
                    <h4 class="card-title">Update recipe</h4>
                </div>
            </div>
            <div class="card-body">
                <form id="editRecipeForm" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="text" value="{{ $recipe->id }}" name="id" style="display: none">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group bmd-form-group" style="margin-top: 52px;">
                                <label class="bmd-label-floating">Title</label>
                                <input type="text" class="form-control" name="title" value="{{ $recipe->title }}">
                                <label id="title_error" class="error" for="required"
                                    style="display: none;color: red"></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Category</label>
                                <select class="form-control selectpicker" data-style="btn btn-link"
                                    id="categories_select" name="category_id">
                                    <option value="0"></option>
                                    @foreach ($categories as $key=>$category)
                                    <option value="{{ $key }}" {{ $key == $recipe->category_id ? 'selected' : '' }}>
                                        {{ $category }}</option>
                                    @endforeach
                                </select>
                                <label id="category_id_error" class="error" for="required"
                                    style="display: none;color: red"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group bmd-form-group">
                                <label class="bmd-label-floating">Components</label>
                                <input type="text" class="form-control" name="components"
                                    value="{{ $recipe->components }}">
                                <label id="components_error" class="error" for="required"
                                    style="display: none;color: red"></label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <img width="300px" height="250px" src="{{ asset('images/recipes/'.$recipe->image) }}" alt="">
                    <div class="row">
                        <span>Choose file</span>
                        <input type="file" name="image">
                        <label id="image_error" class="error" for="required" style="display: none;color: red"></label>
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Content</label>
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating"> Write some pargraph for recipe.</label>
                                    <textarea class="form-control" rows="5"
                                        name="content">{{ $recipe->content }}</textarea>
                                    <label id="content_error" class="error" for="required"
                                        style="display: none;color: red"></label>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer ml-auto mr-auto">
                <button id="update_recipe" type="submit" class="btn btn-success">Update Recipe<div
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
    $('.fileupload').fileupload()
</script>
<script>
    $(document).on('click', '#update_recipe', function(e){
        e.preventDefault();
        var formData = new FormData($('#editRecipeForm')[0]);

        $.ajax({
            type:'post',
            enctype: 'multipart/form-data',
            url: "{{ route('recipe.update',$recipe->id) }}",
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