@extends('index')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-pendrive icon-gradient bg-amy-crisp">
                </i>
            </div>
            <div>{{ $category->category ?? '' }}
                <div class="page-title-subheading">List of Fire Detection and Alarm System
                </div>
            </div>
        </div>    
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card p-3">
            <div class="body" id="content">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-primary waves-effect btn-new">
                                <i class="fas fa-user-tie"></i>
                                <span>New</span>
                            </button>
                            <a type="button"  href="{{ route('manage-devices').'?status=1&id='.request('id') }}" class="btn btn-sm btn-info waves-effect btn-active">
                                <i class="fas fa-check-square"></i>
                                <span>Active</span>
                            </a>
                            <a type="button"  href="{{ route('manage-devices').'?status=0&id='.request('id') }}" class="btn btn-sm btn-secondary waves-effect btn-trash">
                                <i class="fas fa-trash-alt"></i>
                                <span>Trash</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        <a type="submit" href="{{ route('fdas') }}" class="btn btn-sm btn-secondary text-white"><i class="fas fa-undo mr-2"></i>Back</a>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="display table table-striped table-hover dataTable" id="table-list">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Device / Appliance Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($ctr = 1)
                            @if(!blank($category))
                                @foreach ($category->devices as $device)
                                    @if ($device->status == $status)
                                        <tr>
                                            <td class="text-center">{{ $ctr++ }}</td>
                                            <td>{{ $device->name }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-warning waves-effect btn-edit" title="Edit Device Info" value="{{ $device->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                @if($device->status == 1)
                                                <button type="button" class="btn btn-sm btn-danger waves-effect btn-delete" title="Deactivate Device Info" value="{{ $device->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                @endif
                                                @if($device->status == 0)
                                                <button type="button" class="btn btn-sm btn-success waves-effect btn-activate"  title="Re-activate Device Info" value="{{ $device->id }}">
                                                    <i class="fas fa-undo-alt"></i>
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $('#table-list').DataTable();
    var categ = "{{ request('id') ?? 0 }}";

    $('body').on('click', '.btn-new', function(){
        deviceCreate(categ, 0);
    });

    $('body').on('click', '.btn-edit', function(){
        var id = $(this).val();
        deviceCreate(categ, id);
    });

    $('body').on('click', '.btn-delete', function(){
        var id = $(this).val();

        swal.fire({
            title: "Confirm",
            text: "Are you sure you want to delete this device / appliance?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Proceed",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                toggleDeviceStatus(id, 0);
            }
        });
    });

    $('body').on('click', '.btn-activate', function(){
        var id = $(this).val();
        toggleDeviceStatus(id, 1);
    });

    function deviceCreate(category, id){
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/fdas-device-create',
            method: 'POST',
            data: {'category': category, 'id': id},
            dataType: 'html',
            beforeSend: function() {
                $('#content').html('<div class="progress" style="height: 13px;">' +
                                    '<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">' +
                                    '<span class="sr-only">40% Complete (success)</span>' +
                                    '</div>' +
                                    '</div>');
            },
            complete: function(){
                
            },
            success: function(result) {
                $('#content').html(result);
            },
            error: function(obj, err, ex){
                Swal.fire({
                    title: 'Server Error',
                    text: err + ": " + obj.toString() + " " + ex,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
    }

    function toggleDeviceStatus(id, status){
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/fdas-device-toggle-status',
            method: 'POST',
            data: {'id': id, 'status': status},
            dataType: 'JSON',
            success: function(result) {
                swal.fire(result['title'], result['message'], result['icon']);

                if (result['icon'] != 'error'){
                    location.reload();
                }
            },
            error: function(obj, err, ex){
                Swal.fire({
                    title: 'Server Error',
                    text: err + ": " + obj.toString() + " " + ex,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
    }
</script>
@endpush



