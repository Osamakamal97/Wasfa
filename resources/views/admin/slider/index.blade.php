@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                </div>
                <div class="row">
                    <h4 class="card-title col-md-9">Sliders</h4>
                    <a href="{{ route('slider.create') }}" class="btn btn-primary" style="margin-top: 15px">
                        Create slider</a>
                </div>
            </div>
            <div class="card-body">
                <div class="material-datatables">
                    <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="datatables"
                                    class="table table-striped table-no-bordered table-hover dataTable dtr-inline"
                                    style="width: 100%;" role="grid" aria-describedby="datatables_info" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr role="row">
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>status</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>stuatus</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($sliders as $slider)
                                        <tr role="row">
                                            <td>
                                                <img width="{{INDEX_IMAGE_WIDTH}}" height="{{INDEX_IMAGE_HEIGH}}"
                                                    rel="nofollow" alt="..."
                                                    src="{{ asset('images/recipes/'.$slider->image) }}">
                                            </td>
                                            <td>{{ $slider->title }}</td>
                                            <td>{{ $slider->status }}</td>
                                            <td class="text-right">
                                                <a href="{{ route('slider.edit',$slider->id) }}"
                                                    class="btn btn-link btn-warning btn-just-icon {{-- edit --}}"><i
                                                        class="material-icons">dvr</i></a>
                                                <a href="#" class="btn btn-link btn-danger btn-just-icon remove"><i
                                                        class="material-icons">close</i></a>
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
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function() {
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
        }
      });
  
      var table = $('#datatables').DataTable();
  
      // Edit record
      table.on('click', '.edit', function() {
        $tr = $(this).closest('tr');
        var data = table.row($tr).data();
        alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
      });
      // Delete a record
      table.on('click', '.remove', function(e) {
        e.preventDefault();
        $tr = $(this).closest('tr');
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
            $.ajax({
                type:'delete',
                url: "{{ route('slider.destroy', $slider->id ) }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                },
                success: function(data){
                    if(data.status){
                        Swal.fire(
                            'Deleted!',
                            data.message,
                            'success'
                        )
                    table.row($tr).remove().draw();
                    }else{
                        Swal.fire(
                            'Error!',
                            data.message,
                            'error'
                        )
                    }
                },error: function(error){}
            });
        }else{
            Swal.fire(
                'Canceled!',
                'Delete Recipe Cancel',
                'success'
            )
        }
        })
      });
      //Like record
      table.on('click', '.like', function() {
        alert('You clicked on Like button');
      });
    });
</script>
@endpush