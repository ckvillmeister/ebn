@extends('index')
@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-pendrive icon-gradient bg-amy-crisp">
                </i>
            </div>
            <div>Fire Detection Alarm System
                <div class="page-title-subheading">Manager for list of Fire Device / Appliances System
                </div>
            </div>
        </div>    
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card p-3">
            <div class="body" id="content">

            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    getCategories(1);

    $('body').on('click', '.btn-new', function(){
        categoryCreate(0);
    });

    $('body').on('click', '.btn-edit', function(){
        var id = $(this).val();
        categoryCreate(id);
    });

    $('body').on('click', '.btn-delete', function(){
        var id = $(this).val();

        swal.fire({
            title: "Confirm",
            text: "Are you sure you want to delete this FDAS category?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Proceed",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                toggleCategoryStatus(id, 0);
            }
        });
    });

    $('body').on('click', '.btn-activate', function(){
        var id = $(this).val();
        toggleCategoryStatus(id, 1);
    });

    $('body').on('click', '.btn-active', function(){
        getCategories(1);
    });

    $('body').on('click', '.btn-trash', function(){
        getCategories(0);
    });

    function categoryCreate(id){
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/fdas-categ-create',
            method: 'POST',
            data: {'id': id},
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

    function getCategories(status){
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/fdas-categ-retrieve',
            method: 'POST',
            data: {'status': status},
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

    function toggleCategoryStatus(id, status){
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/fdas-categ-toggle-status',
            method: 'POST',
            data: {'id': id, 'status': status},
            dataType: 'JSON',
            success: function(result) {
                swal.fire(result['title'], result['message'], result['icon']);

                if (result['icon'] != 'error'){
                    if (status){
                        getCategories(0);
                    }
                    else{
                        getCategories(1);
                    }
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



